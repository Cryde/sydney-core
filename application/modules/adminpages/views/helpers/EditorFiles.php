<?php

/**
 * Helper showing the file browser inline for content editing
 */
class Adminpages_View_Helper_EditorFiles extends Zend_View_Helper_Abstract
{
    /**
     * Helper main function
     * @return String HTML to be inserted in the view
     */
    public function EditorFiles()
    {
        $mrt = array(
            array(
                'All types',
                'Add one or several files',
                "{'filter':0,'mode':'thumb'}"
            ),
            array(
                'Picture',
                'Add one or several images',
                "{'filter':1,'mode':'thumb'}"
            ),
            array(
                'Video',
                'Add one or several videos',
                "{'filter':2,'mode':'thumb'}"
            ),
            array(
                'Audio',
                'Add one or several audio files',
                "{'filter':3,'mode':'list'}"
            ),
            array(
                'Office document',
                'Add one or several MS office or Open office documents',
                "{'filter':4,'mode':'list'}"
            ),
            array(
                'PDF',
                'Add one or several Adobe Acrobat files',
                "{'filter':5,'mode':'list'}"
            ),
            //	array('Flash',		    'Add one or several Flash files', "{'filter':6,'mode':'list'}"),
            array(
                'By category',
                'Add files based on their category',
                "{'filter':7,'mode':'list'}"
            ),
        );

        $toReturn = '<div class="editor files edefiles file-block"><form><ul class="action-list sydney_editor_ul" data-content-type="file-block"><div class="row">';
        foreach ($mrt as $d) {
            $toReturn .= '<div class="col-lg-3"><li fileparams="' . $d[2] . '"><div class="panel panel-warning"><div class="panel-heading"><span class="text-primary">' . $d[0] . ' </span><span class="small"> ' . $d[1] . '</span></div></div></li></div>';
        }
        $toReturn .= '</div></ul></form></div>';

        return $toReturn;
    }
}
