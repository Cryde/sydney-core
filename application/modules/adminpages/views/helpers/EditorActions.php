<?php

/**
 * Helper showing the heading editor for page content editing
 */
class Adminpages_View_Helper_EditorActions extends Zend_View_Helper_Abstract
{
    /**
     * Helper main function
     *
     * @param Boolean $isDeletable
     * @param Boolean $isDraft
     * @param Integer $isOnline
     * @param Boolean $workflowEnabled
     * @param Boolean $isEditable
     * @param String $msgNotEditable
     * @param Array $params
     * @return String HTML to be inserted in the view
     */
    public function EditorActions($isDeletable = true, $isDraft = false, $isOnline = 0, $workflowEnabled = false, $isEditable = true, $accessRightsEnabled = false, $msgNotEditable = 'Not editable...', $params = array(), $isShared = false)
    {

        if (!$isEditable) {
            return '<div class="actions"><div class="notEditable">' . $msgNotEditable . '</div></div>';
        }
        $toReturn = '<div class="actions pull-right"><label class="text-muted labelEditAction" id="labelEditAction-' . $params['dbid'] . '">' . $params['label'] . '</label>';

        $toReturn .= '<a id="duplicatediv-' . $params['dbid'] . '" class="btn btn-sm btn-warning sydney_editor_a" href="#">Duplicate</a> ';

        if ($accessRightsEnabled) {
            $toReturn .= '<a class="btn btn-sm btn-default sydney_editor_a" href="accessrightsstatus">Access Rights</a> ';
        }

        if (!(false == $isDeletable && false == $isDraft)) {
            if ($isDraft) {
                $toReturn .= '<a class="btn btn-sm btn-success" href="publishdiv">Save as actual content</a> ';
            } else {
                $toReturn .= '<a class="btn btn-sm btn-info" href="unpublishdiv">Save as draft</a> ';
            }
            if (!$isDeletable) {
                $toReturn .= '<a class="btn btn-sm btn-danger" href="rollback">Delete draft</a> ';
            } else {
                if (!$isShared) {
                    $toReturn .= '<a class="btn btn-sm btn-danger" href="delete">Delete</a> ';
                }
            }
        }
        $toReturn .= '<a class="btn btn-sm btn-primary" href="edit">Edit</a> ';
        if ($workflowEnabled) {
            $toReturn .= '<a class="btn btn-sm btn-default" href="workflowstatus">Change status</a> ';
        }

        if (!$isDraft) {
            if ($isOnline) {
                $toReturn .= '<a id="offlinediv-' . $params['dbid'] . '" class="btn btn-sm btn-danger" href="#">Unpublish</a>';
            } else {
                $toReturn .= '<a id="offlinediv-' . $params['dbid'] . '" class="btn btn-sm btn-success" href="#">Publish</a>';
            }
        }

        $toReturn .= '</div>
					<div class="move"><a class="btn btn-primary btn-outline" title="Move" href="#">
					<i class="fa fa-arrows"></i></a>
					</div>';

        return $toReturn;
    }

}
