<?php

/**
 * BaseUserCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $category_id
 * @property boolean $subscribe
 * @property User $User
 * @property Category $Category
 * 
 * @method integer      getUserId()      Returns the current record's "user_id" value
 * @method integer      getCategoryId()  Returns the current record's "category_id" value
 * @method boolean      getSubscribe()   Returns the current record's "subscribe" value
 * @method User         getUser()        Returns the current record's "User" value
 * @method Category     getCategory()    Returns the current record's "Category" value
 * @method UserCategory setUserId()      Sets the current record's "user_id" value
 * @method UserCategory setCategoryId()  Sets the current record's "category_id" value
 * @method UserCategory setSubscribe()   Sets the current record's "subscribe" value
 * @method UserCategory setUser()        Sets the current record's "User" value
 * @method UserCategory setCategory()    Sets the current record's "Category" value
 * 
 * @package    dockeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUserCategory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('user_category');
        $this->hasColumn('user_id', 'integer', null, array(
             'notnull' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('category_id', 'integer', null, array(
             'notnull' => true,
             'type' => 'integer',
             ));
        $this->hasColumn('subscribe', 'boolean', null, array(
             'type' => 'boolean',
             ));


        $this->index('user_category_unique', array(
             'fields' => 
             array(
              0 => 'user_id',
              1 => 'category_id',
             ),
             'type' => 'unique',
             ));
        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'cascade',
             'onUpdate' => 'cascade'));

        $this->hasOne('Category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'cascade',
             'onUpdate' => 'cascade'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}