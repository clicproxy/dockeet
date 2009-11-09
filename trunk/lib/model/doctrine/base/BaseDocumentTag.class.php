<?php

/**
 * BaseDocumentTag
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $document_id
 * @property integer $tag_id
 * 
 * @method integer     getDocumentId()  Returns the current record's "document_id" value
 * @method integer     getTagId()       Returns the current record's "tag_id" value
 * @method DocumentTag setDocumentId()  Sets the current record's "document_id" value
 * @method DocumentTag setTagId()       Sets the current record's "tag_id" value
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6670 2009-11-04 19:52:45Z jwage $
 */
abstract class BaseDocumentTag extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document_tag');
        $this->hasColumn('document_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));
        $this->hasColumn('tag_id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}