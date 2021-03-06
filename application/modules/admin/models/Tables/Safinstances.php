<?php
/**
 * File generated by the Sydney_Admin_Generator v2.0
 */

/**
 * Mapping of the Safinstances table in an object
 * @package Admindb
 * @subpackage ModelGenerated
 */
class Safinstances extends SafinstancesOp
{
    protected $_schema = 'sydney';
    protected $_name = 'safinstances';
    protected $_dependentTables = array(
        'Filfiles',
        'Filfolders',
        'Filmetadata',
        'PagmenusSafinstances',
        'Pagstructure',
        'Parameters',
        'Safactivitylog',
        'SafinstancesSafmodules',
        'SafinstancesUsers',
        'TranslationData',
        'Users',
    );
    protected $_referenceMap = array(
        'Languages'        => array(
            'columns'       => 'languages_id',
            'refTableClass' => 'Languages',
            'refColumns'    => 'id'
        ),
    );
    protected $_primary = 'id';

    public $fieldsNames = array(
        'id', // bigint()
        'label', // varchar(50)
        'domain', // varchar(50)
        'description', // varchar(200)
        'languages_id', // bigint()
        'secdomains', // text()
        'creationdate', // datetime()
        'offlinedate', // datetime()
        'active', // tinyint()
        'offlinemessage', // text()
        'metatags', // text()
    );

    protected $_metadata = array(
        'id'                  => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "id",
            'COLUMN_POSITION'  => 1,
            'DATA_TYPE'        => "bigint",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => true,
            'PRIMARY_POSITION' => 1,
            'IDENTITY'         => true,
        ),
        'label'               => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "label",
            'COLUMN_POSITION'  => 2,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => "50",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'domain'              => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "domain",
            'COLUMN_POSITION'  => 3,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => "50",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'description'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "description",
            'COLUMN_POSITION'  => 4,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => "200",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'languages_id'        => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "languages_id",
            'COLUMN_POSITION'  => 6,
            'DATA_TYPE'        => "bigint",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'creationdate'        => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "creationdate",
            'COLUMN_POSITION'  => 9,
            'DATA_TYPE'        => "datetime",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'offlinedate'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "offlinedate",
            'COLUMN_POSITION'  => 10,
            'DATA_TYPE'        => "datetime",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'active'              => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "active",
            'COLUMN_POSITION'  => 11,
            'DATA_TYPE'        => "tinyint",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'offlinemessage'      => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "offlinemessage",
            'COLUMN_POSITION'  => 12,
            'DATA_TYPE'        => "text",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'metakeywords'            => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "safinstances",
            'COLUMN_NAME'      => "metatags",
            'COLUMN_POSITION'  => 14,
            'DATA_TYPE'        => "text",
            'DEFAULT'          => null,
            'NULLABLE'         => true,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
    );

    public function __construct($id = 0)
    {
        $this->_schema = Sydney_Tools_Sydneyglobals::getConf()->db->params->dbname;
        parent::__construct($id);
    }

}
