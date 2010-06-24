<?php

class importZipTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('library', sfCommandArgument::REQUIRED, 'Library prefix'),
      new sfCommandArgument('file', sfCommandArgument::REQUIRED, 'Zip file to import')
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'import';
    $this->name             = 'zip';
    $this->briefDescription = 'Import archive ZIP';
    $this->detailedDescription = <<<EOF
The [import:zip|INFO] task does things.
Call it with:

  [php symfony import:zip|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	ini_set('memory_limit', '1024M');
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    $sf_filesystem = new sfFilesystem();
    $library = Doctrine::getTable('Library')->findOneBy('prefix', $arguments['library']);
    if (!$library instanceof Library)
    {
    	throw new sfException(sprintf("Library prefix '%s' unknown.", $arguments['library']));
    }
    $manager = Doctrine_Manager::getInstance();
    $manager->setAttribute(Doctrine_Core::ATTR_TBLNAME_FORMAT, $library->prefix . '_%s');

    // add your code here
    $zip_archive = new ZipArchive();
    $zip_archive->open($arguments['file']);
    $extract_path = sfConfig::get('sf_cache_dir') . '/' . date('Y.m.d-H.i') . '/';
    $zip_archive->extractTo($extract_path);


    $directory_iterator = $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($extract_path), RecursiveIteratorIterator::SELF_FIRST);
    $category_path = '';
    $category = null;
		foreach ($directory_iterator as $filename => $spl_file_info)
		{
			try
			{
				if (false !== strpos($filename, '__MACOSX') || false !== strpos($filename, 'DS_Store') || 0 === strpos(basename($filename), '.')) continue;

				$relative_path = str_replace($extract_path, '', $filename);

				if (is_dir($filename))
				{
					$category_path = str_replace('/', '|', $relative_path);
					$category = Doctrine::getTable('Category')->findOneby('title', $category_path);

					if (!$category instanceof Category)
					{
						$category = new Category();
						$category->title = $category_path;
						$category->save();
					}
				}
				else
				{
	        $category_path = str_replace('/', '|', dirname($relative_path));
	        $category = Doctrine::getTable('Category')->findOneby('title', $category_path);
	        if (!$category instanceof Category)  throw new sfException(sprintf("Category %s unknown.", $category->title));
				}

				if (is_file($filename))
				{
					$title = substr(basename($filename), 0, strrpos(basename($filename), '.'));
					$document_file = sha1(date('U') . $filename) . substr($filename, strrpos($filename, '.'));

					$document = Doctrine::getTable('Document')->findOneBy('title', $title);

					if (!$document instanceof Document)
					{
						$document = new Document();
						$document->title = $title;

					}

					$document->file = $document_file;
					$document->save();

	        $path = sfConfig::get('sf_upload_dir') . '/' . $library->prefix . '/documents/' . substr(str_pad($document->id, 2, '0', STR_PAD_LEFT), -2) . '/';
	        $thumbnail_path = sfConfig::get('sf_upload_dir') . '/' . $library->prefix . '/thumbnail/' . substr(str_pad($document->id, 2, '0', STR_PAD_LEFT), -2);
	        if (! is_dir($path)) mkdir($path, 0777, true);
	        if (! is_writable($path)) throw new sfException("Write directory access denied");

	        $sf_filesystem->copy($filename, $path . '/' . $document_file);

		      if (class_exists('finfo_open'))
		      {
		        $finfo = finfo_open(FILEINFO_MIME_TYPE);
		        $mime_type = finfo_file($finfo, $path . '/' . $document_file);
		      }
		      else
		      {
		        $mime_type = mime_content_type($path . '/' . $document_file);
		      }
		      $document->mime_type = $mime_type;
		      $document->size = $spl_file_info->getSize();
		      if (0 === Doctrine::getTable('DocumentCategory')->createQuery('d')->where('document_id = ? and category_id = ?', array($document->id, $category->id))->count()) $document->Categories[] = $category;


		      if (in_array($mime_type, array('image/jpeg', 'image/png', 'image/gif', 'application/pdf')))
		      {
		        if (!is_dir($thumbnail_path)) mkdir($thumbnail_path, 0777, true);
		        if (! is_writable($path)) throw new sfException("Write directory access denied");

		        $adapterOptions = array();
		        if (in_array($mime_type, array('application/pdf')))
		        {
		          $adapterOptions['extract'] = 1;
		        }
		        //$maxWidth = null, $maxHeight = null, $scale = true, $inflate = true, $quality = 75, $adapterClass = null, $adapterOptions = array()
		        $thumbnail = new sfThumbnail(125, 125, true, true, 75, 'sfImageMagickAdapter', $adapterOptions);
		        $thumbnail->loadFile($path . '/' . $document_file);
		        $thumbnail->save($thumbnail_path . '/125x125_' . substr($document->file, 0, strrpos($document->file, '.')) . '.png');
		      }
		      $document->save();
				}
			}
			catch (exception $e)
			{
				echo sprintf("Erreur '%s' dans le fichier %s à la ligne %s\n", $e->getMessage(), $e->getFile(), $e->getLine());
				continue;
	    }
		}
		$sf_filesystem->remove(sfConfig::get('sf_cache_dir') . '/' . date('Y.m.d-H.i') . '/');
  }
}
