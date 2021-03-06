<?php
/**
 * File generated by the Sydney_Admin_Generator v2.0
 */

/**
 * Mapping of the Filtype table in an object
 * @package Admindb
 * @subpackage ModelGenerated
 */
class Filtype extends FiltypeOp
{
    protected $_schema = 'sydney';
    protected $_name = 'filtype';
    protected $_dependentTables = array('Filfiles', 'FilmetadataFiltype');
    protected $_referenceMap = array(
        'Filmediatype' => array(
            'columns'       => 'filmediatype_id',
            'refTableClass' => 'Filmediatype',
            'refColumns'    => 'id'
        ),
    );
    protected $_primary = 'id';

    public $fieldsNames = array(
        'id', // bigint()
        'ext', // varchar(4)
        'class', // varchar(255)
        'label', // varchar(100)
        'uploadable', // tinyint()
        'clientresizeable', // tinyint()
        'mimetype', // varchar(200)
        'filmediatype_id', // bigint()
    );

    protected $_metadata = array(
        'id'               => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
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
        'ext'              => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "ext",
            'COLUMN_POSITION'  => 2,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => true,
            'LENGTH'           => "4",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'class'            => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "class",
            'COLUMN_POSITION'  => 3,
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
        'label'            => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "label",
            'COLUMN_POSITION'  => 4,
            'DATA_TYPE'        => "varchar",
            'DEFAULT'          => null,
            'NULLABLE'         => false,
            'LENGTH'           => "100",
            'SCALE'            => null,
            'PRECISION'        => null,
            'UNSIGNED'         => null,
            'PRIMARY'          => false,
            'PRIMARY_POSITION' => null,
            'IDENTITY'         => false,
        ),
        'uploadable'       => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "uploadable",
            'COLUMN_POSITION'  => 5,
            'DATA_TYPE'        => "tinyint",
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
        'clientresizeable' => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "clientresizeable",
            'COLUMN_POSITION'  => 6,
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
        'mimetype'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "mimetype",
            'COLUMN_POSITION'  => 7,
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
        'filmediatype_id'  => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "filtype",
            'COLUMN_NAME'      => "filmediatype_id",
            'COLUMN_POSITION'  => 8,
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
    );

    public function __construct($id = 0)
    {
        $this->_schema = Sydney_Tools_Sydneyglobals::getConf()->db->params->dbname;
        parent::__construct($id);
    }

}
