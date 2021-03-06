<?php
/**
 * File generated by the Sydney_Admin_Generator v2.0
 */

/**
 * Mapping of the PagstructurePagmenus table in an object
 * @package Admindb
 * @subpackage ModelGenerated
 */
class PagstructurePagmenus extends PagstructurePagmenusOp
{
    protected $_schema = 'sydney';
    protected $_name = 'pagstructure_pagmenus';
    protected $_referenceMap = array(
        'Pagstructure' => array(
            'columns'       => 'pagstructure_id',
            'refTableClass' => 'Pagstructure',
            'refColumns'    => 'id'
        ),
        'Pagmenus'     => array(
            'columns'       => 'pagmenus_id',
            'refTableClass' => 'Pagmenus',
            'refColumns'    => 'id'
        ),
    );
    protected $_primary = 'id';

    public $fieldsNames = array(
        'pagstructure_id', // bigint()
        'pagmenus_id', // bigint()
        'id', // bigint()
    );

    protected $_metadata = array(
        'pagstructure_id' => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstructure_pagmenus",
            'COLUMN_NAME'      => "pagstructure_id",
            'COLUMN_POSITION'  => 1,
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
        'pagmenus_id'     => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstructure_pagmenus",
            'COLUMN_NAME'      => "pagmenus_id",
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
        'id'              => array(
            'SCHEMA_NAME'      => null,
            'TABLE_NAME'       => "pagstructure_pagmenus",
            'COLUMN_NAME'      => "id",
            'COLUMN_POSITION'  => 3,
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
    );

    /**
     * Returns the list of IDs linked to a "Pagstructure"
     *
     * @param Int $id ID of the pagmenus
     * @return Array list of IDs
     */
    public function getPagstructureLinkedTo($id)
    {
        if (preg_match("/[0-9]{1,9}/", $id)) {
            $toreturn = array();
            $rows = $this->fetchAll($this->select()->where('pagmenus_id = ?', $id));
            foreach ($rows->toArray() as $v) {
                $toreturn[] = $v['pagstructure_id'];
            }

            return $toreturn;
        } else {
            return array();
        }
    }

    /**
     * Sets the data linked to an id in the "Pagstructure" table
     *
     * @param Int $id ID of the pagmenus
     * @param Array list of IDs
     * @return Boolean true if success and false if there were an error
     */
    public function setPagstructureLinkedTo($id, array $data)
    {
        if (preg_match("/[0-9]{1,9}/", $id) && is_array($data)) {
            $where = $this->getAdapter()->quoteInto('pagstructure_id = ?', $id);
            $this->delete($where);
            foreach ($data as $v) {
                $this->insert(array(
                    'pagstructure_id' => $id,
                    'pagmenus_id'     => $v
                ));
            }
        } else {
            return false;
        }
    }

    /**
     * Returns the list of IDs linked to a "Pagmenus"
     *
     * @param Int $id ID of the pagstructure
     * @return Array list of IDs
     */
    public function getPagmenusLinkedTo($id)
    {
        if (preg_match("/[0-9]{1,9}/", $id)) {
            $toreturn = array();
            $rows = $this->fetchAll($this->select()->where('pagstructure_id = ?', $id));
            foreach ($rows->toArray() as $v) {
                $toreturn[] = $v['pagmenus_id'];
            }

            return $toreturn;
        } else {
            return array();
        }
    }

    /**
     * Sets the data linked to an id in the "Pagmenus" table
     *
     * @param Int $id ID of the pagstructure
     * @param Array list of IDs
     * @return Boolean true if success and false if there were an error
     */
    public function setPagmenusLinkedTo($id, array $data)
    {
        if (preg_match("/[0-9]{1,9}/", $id) && is_array($data)) {
            $where = $this->getAdapter()->quoteInto('pagmenus_id = ?', $id);
            $this->delete($where);
            foreach ($data as $v) {
                $this->insert(array(
                    'pagmenus_id'     => $id,
                    'pagstructure_id' => $v
                ));
            }
        } else {
            return false;
        }
    }

    public function __construct($id = 0)
    {
        $this->_schema = Sydney_Tools_Sydneyglobals::getConf()->db->params->dbname;
        parent::__construct($id);
    }

}
