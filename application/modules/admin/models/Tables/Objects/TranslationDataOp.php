<?php
/**
 * File generated by the Sydney_Admin_Generator
 */

/**
 * @package Admindb
 * @subpackage ModelGenerated
 */
class TranslationDataOp extends Sydney_Db_Table
{

    public function getByTableName(Array $tableName, $lang, $tableId = 0, $tableField = null)
    {
        $this->selector = $this->select()
            ->where('safinstances_id = ' . Sydney_Tools_Sydneyglobals::getSafinstancesId())
            ->where('tbl_name IN ("' . implode('","', $tableName) . '")')
            ->where('code_language = "' . $lang . '"');

        if ($tableField !== null) {
            $this->selector = $this->selector->where('tbl_field = "' . $tableField . '"');
        }

        if ($tableId > 0) {
            $this->selector = $this->selector->where('tbl_id = "' . $tableId . '"');
        }

        return $this->fetchAll($this->selector);
    }

    public function getRowByTableName(Array $tableName, $lang, $tableId, $tableField = '')
    {
        return $this->getByTableName($tableName, $lang, $tableId, $tableField)->current();
    }

    public function save($label, Sydney_Content_Translator $translate, $lang, $tableId, $tableField = '')
    {
        $rowTranlationData = $this->getRowByTableName(array($translate->getTableName()), $lang, $tableId, $tableField);

        // If exist then update row
        if ($rowTranlationData) {
            $rowTranlationData->label = $label;
            $result = $this->update(array(
                    'label' => $label
                ), 'tbl_name = "' . $translate->getTableName() . '" AND tbl_id = ' . intval($tableId) . ' AND code_language = "' . $lang . '"
                    AND tbl_field = "' . $tableField . '" AND safinstances_id = ' . Sydney_Tools_Sydneyglobals::getSafinstancesId());
        } else { // Else create row
            $result = $this->insert(array(
                'label'           => $label,
                'tbl_name'        => $translate->getTableName(),
                'tbl_id'          => intval($tableId),
                'tbl_field'       => $tableField,
                'code_language'   => $lang,
                'safinstances_id' => Sydney_Tools_Sydneyglobals::getSafinstancesId()
            ));
        }

        // Clear cache
        $cache = Zend_Registry::get('cache');
        $cache->clean(Zend_Cache::CLEANING_MODE_ALL);

        return $result;
    }

}
