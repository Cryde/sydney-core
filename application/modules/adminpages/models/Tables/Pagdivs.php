<?php
/**
 * File generated by the Sydney_Admin_Generator v2.0
 */

/**
 * Mapping of the Pagdivs table in an object
 * @package Admindb
 * @subpackage ModelGenerated
 */
class Pagdivs extends PagdivsOp
{
    protected $_schema = 'sydney';
    protected $_name = 'pagdivs';
    protected $_dependentTables = array('PagstructurePagdivs');
    protected $_referenceMap = array(

        'Usersgroups' => array(
            'columns'       => 'usersgroups_id',
            'refTableClass' => 'Usersgroups',
            'refColumns'    => 'id'
        )
    );
    protected $_primary = 'id';

    public $fieldsNames = array(
        'id', // bigint()
        'label', // varchar(45)
        'params', // text()
        'params_draft', // varchar(255)
        'content', // longtext()
        'content_draft', // longtext()
        'content_type_label',
        'status', // enum('draft','revised','published','restored')()
        'datecreated', // timestamp()
        'datemodified', // timestamp()
        'order', // int()
        'usersgroups_id', // bigint()
        'isDeleted', // smallint()
        'wrkstatuses_id', // bigint()
        'online', // tinyint()
    );

    protected $_metadata = array(
        'id'             => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
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
        'label'          => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "label",
            'COLUMN_POSITION'  => 2,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => true,
            'LENGTH'           => "45",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'params'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "params",
            'COLUMN_POSITION'  => 3,
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
        'params_draft'   => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "params_draft",
            'COLUMN_POSITION'  => 4,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => true,
            'LENGTH'           => "255",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'content'        => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "content",
            'COLUMN_POSITION'  => 5,
            'DATA_TYPE'        => "longtext",
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
        'content_draft'  => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "content_draft",
            'COLUMN_POSITION'  => 6,
            'DATA_TYPE'        => "longtext",
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
        'content_type_label'          => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "content_type_label",
            'COLUMN_POSITION'  => 2,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => true,
            'LENGTH'           => "150",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'status'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "status",
            'COLUMN_POSITION'  => 8,
            'DATA_TYPE'        => "enum('draft','revised','published','restored')",
            'DEFAULT'          => "draft",
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'datecreated'    => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "datecreated",
            'COLUMN_POSITION'  => 9,
            'DATA_TYPE'        => "timestamp",
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
        'datemodified'   => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "datemodified",
            'COLUMN_POSITION'  => 10,
            'DATA_TYPE'        => "timestamp",
            'DEFAULT'          => "CURRENT_TIMESTAMP",
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'order'          => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "order",
            'COLUMN_POSITION'  => 11,
            'DATA_TYPE'        => "int",
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
        'usersgroups_id' => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "usersgroups_id",
            'COLUMN_POSITION'  => 12,
            'DATA_TYPE'        => "bigint",
            'DEFAULT'          => "1",
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'isDeleted'      => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "isDeleted",
            'COLUMN_POSITION'  => 13,
            'DATA_TYPE'        => "smallint",
            'DEFAULT'          => "0",
            'NULLABLE'         => false,
            'LENGTH'           => null,
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'wrkstatuses_id' => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "wrkstatuses_id",
            'COLUMN_POSITION'  => 14,
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
        'online'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagdivs",
            'COLUMN_NAME'      => "online",
            'COLUMN_POSITION'  => 15,
            'DATA_TYPE'        => "tinyint",
            'DEFAULT'          => "0",
            'NULLABLE'         => false,
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
