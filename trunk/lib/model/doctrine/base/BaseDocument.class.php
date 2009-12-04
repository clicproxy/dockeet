<?php

/**
 * BaseDocument
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property clob $description
 * @property string $file
 * @property string $mime_type
 * @property boolean $public
 * @property Doctrine_Collection $Categories
 * @property Doctrine_Collection $Tags
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Versions
 * @property Doctrine_Collection $DocumentCategory
 * @property Doctrine_Collection $UserDocument
 * 
 * @method string              getTitle()            Returns the current record's "title" value
 * @method clob                getDescription()      Returns the current record's "description" value
 * @method string              getFile()             Returns the current record's "file" value
 * @method string              getMimeType()         Returns the current record's "mime_type" value
 * @method boolean             getPublic()           Returns the current record's "public" value
 * @method Doctrine_Collection getCategories()       Returns the current record's "Categories" collection
 * @method Doctrine_Collection getTags()             Returns the current record's "Tags" collection
 * @method Doctrine_Collection getUsers()            Returns the current record's "Users" collection
 * @method Doctrine_Collection getVersions()         Returns the current record's "Versions" collection
 * @method Doctrine_Collection getDocumentCategory() Returns the current record's "DocumentCategory" collection
 * @method Doctrine_Collection getUserDocument()     Returns the current record's "UserDocument" collection
 * @method Document            setTitle()            Sets the current record's "title" value
 * @method Document            setDescription()      Sets the current record's "description" value
 * @method Document            setFile()             Sets the current record's "file" value
 * @method Document            setMimeType()         Sets the current record's "mime_type" value
 * @method Document            setPublic()           Sets the current record's "public" value
 * @method Document            setCategories()       Sets the current record's "Categories" collection
 * @method Document            setTags()             Sets the current record's "Tags" collection
 * @method Document            setUsers()            Sets the current record's "Users" collection
 * @method Document            setVersions()         Sets the current record's "Versions" collection
 * @method Document            setDocumentCategory() Sets the current record's "DocumentCategory" collection
 * @method Document            setUserDocument()     Sets the current record's "UserDocument" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6716 2009-11-12 19:26:28Z jwage $
 */
abstract class BaseDocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document');
        $this->hasColumn('title', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'unique' => true,
             'length' => '255',
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('file', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('mime_type', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('public', 'boolean', null, array(
             'type' => 'boolean',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Category as Categories', array(
             'refClass' => 'DocumentCategory',
             'local' => 'document_id',
             'foreign' => 'category_id'));

        $this->hasMany('Tag as Tags', array(
             'refClass' => 'DocumentTag',
             'local' => 'document_id',
             'foreign' => 'tag_id'));

        $this->hasMany('User as Users', array(
             'refClass' => 'UserDocument',
             'local' => 'document_id',
             'foreign' => 'user_id'));

        $this->hasMany('DocumentVersion as Versions', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('DocumentCategory', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('UserDocument', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'title',
             ),
             ));
        $searchable0 = new Doctrine_Template_Searchable(array(
             'fields' => 
             array(
              0 => 'title',
              1 => 'description',
              2 => 'file',
             ),
             ));
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
        $this->actAs($searchable0);
    }
}