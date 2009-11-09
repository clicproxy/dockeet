<?php

/**
 * BaseCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $title
 * @property clob $description
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $Documents
 * 
 * @method string              getTitle()       Returns the current record's "title" value
 * @method clob                getDescription() Returns the current record's "description" value
 * @method Doctrine_Collection getUsers()       Returns the current record's "Users" collection
 * @method Doctrine_Collection getDocuments()   Returns the current record's "Documents" collection
 * @method Category            setTitle()       Sets the current record's "title" value
 * @method Category            setDescription() Sets the current record's "description" value
 * @method Category            setUsers()       Sets the current record's "Users" collection
 * @method Category            setDocuments()   Sets the current record's "Documents" collection
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6670 2009-11-04 19:52:45Z jwage $
 */
abstract class BaseCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('category');
        $this->hasColumn('title', 'string', 255, array(
             'notnull' => true,
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('description', 'clob', null, array(
             'type' => 'clob',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('User as Users', array(
             'refClass' => 'UserCategory',
             'local' => 'category_id',
             'foreign' => 'user_id'));

        $this->hasMany('Document as Documents', array(
             'refClass' => 'DocumentCategory',
             'local' => 'category_id',
             'foreign' => 'document_id'));

        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'title',
             ),
             ));
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($sluggable0);
        $this->actAs($timestampable0);
    }
}