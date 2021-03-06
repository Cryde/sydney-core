<?php
/**
 * File generated by the Sydney_Admin_Generator v2.0
 */

/**
 * Mapping of the Pagstats table in an object
 * @package Admindb
 * @subpackage ModelGenerated
 */
class Pagstats extends PagstatsOp
{
    protected $_schema = 'sydney';
    protected $_name = 'pagstats';
    protected $_referenceMap = array(
        'Pagstructure' => array(
            'columns'       => 'pagstructure_id',
            'refTableClass' => 'Pagstructure',
            'refColumns'    => 'id'
        ),
    );
    protected $_primary = 'id';

    public $fieldsNames = array(
        'id', // bigint()
        'pagstructure_id', // bigint()
        'views', // bigint()
        'unique', // bigint()
        'timeonpage', // bigint()
        'bounces', // float()
        'exits', // float()
    );

    protected $_metadata = array(
        'id'              => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
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
        'pagstructure_id' => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "pagstructure_id",
            'COLUMN_POSITION'  => 2,
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
        'views'           => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "views",
            'COLUMN_POSITION'  => 3,
            'DATA_TYPE'        => "bigint",
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
        'unique'          => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "unique",
            'COLUMN_POSITION'  => 4,
            'DATA_TYPE'        => "bigint",
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
        'timeonpage'      => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "timeonpage",
            'COLUMN_POSITION'  => 5,
            'DATA_TYPE'        => "bigint",
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
        'bounces'         => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "bounces",
            'COLUMN_POSITION'  => 6,
            'DATA_TYPE'        => "float",
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
        'exits'           => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstats",
            'COLUMN_NAME'      => "exits",
            'COLUMN_POSITION'  => 7,
            'DATA_TYPE'        => "float",
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
