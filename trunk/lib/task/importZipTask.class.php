<?php

class importZipTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    $this->addArguments(array(
      new sfCommandArgument('file', sfCommandArgument::REQUIRED, 'Zip file to import'),
    ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
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
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();

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

        $path = dirname($document->getFilePath());
        if (! is_dir($path)) mkdir($path, 0777, true);
        if (! is_writable($path)) throw new sfException("Write directory access denied");

        sfFileSystem::copy($filename, $path . '/' . $document_file);

	      if (class_exists('finfo_open'))
	      {
	        $finfo = finfo_open(FILEINFO_MIME_TYPE);
	        $mime_type = finfo_file($finfo, $document->getFilePath());
	      }
	      else
	      {
	        $mime_type = mime_content_type($document->getFilePath());
	      }
	      $document->mime_type = $mime_type;
	      $document->size = $spl_file_info->getSize();
	      if (0 === Doctrine::getTable('DocumentCategory')->createQuery('d')->where('document_id = ? and category_id = ?', array($document->id, $category->id))->count()) $document->Categories[] = $category;


	      if (in_array($mime_type, array('image/jpeg', 'image/png', 'image/gif', 'application/pdf')))
	      {
	        if (!is_dir($document->getThumbnailDirectory())) mkdir($document->getThumbnailDirectory(), 0777, true);
	        if (! is_writable($path)) throw new sfException("Write directory access denied");

	        $adapterOptions = array();
	        if (in_array($mime_type, array('application/pdf')))
	        {
	          $adapterOptions['extract'] = 1;
	        }
	        //$maxWidth = null, $maxHeight = null, $scale = true, $inflate = true, $quality = 75, $adapterClass = null, $adapterOptions = array()
	        $thumbnail = new sfThumbnail(125, 125, true, true, 75, 'sfImageMagickAdapter', $adapterOptions);
	        $thumbnail->loadFile($path . '/' . $document_file);
	        $thumbnail->save(sfConfig::get('sf_web_dir') . $document->getThumbnailUrl(125, 125, true), 'image/png');
	      }
	      $document->save();
			}
    }
  }
}
