<?php
require_once('Zend/View/Helper/Abstract.php');

/**
 * Helper showing the structure of a site in edit mode.
 * This is used in the module page -> structure editor
 *
 * @package SydneyLibrary
 * @subpackage ViewHelper
 * @todo Implement the translation method here
 */
class Sydney_View_Helper_StructureEditor extends Zend_View_Helper_Abstract
{
    /**
     * @var String HTML string to be returned
     */
    private $toReturn;

    /**
     * @var string HTML with all actions for each nodes
     */
    private $strAction;

    private $groups = array();
    /**
     * @var int The current level in the tree
     */
    private $level = 0;

    /**
     * @var array content the list of page with the number of content draft
     */
    private $listDraftContentByPage = array();

    /**
     *
     */
    private $context = 'default'; // actually 2 context: default and ckeditor

    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    private $hasNodeRestored = false;

    /**
     * Helper main function
     * @return String HTML to be inserted in the view
     * @param Array $structureArray [optional] Structure in an array form
     */
    public function structureEditor($structureArray = array())
    {
        $oPageDivs = new Pagdivspage();
        $this->listDraftContentByPage = $oPageDivs->getDivsDraft();

        $grpDB = new Usersgroups();
        $this->groups = $grpDB->fetchLabelstoFlatArray();
        $this->addNodes($structureArray);
        return '<table class="table tree table-condensed">'.$this->toReturn.'</table>';
    }

    /**
     * Add an array of nodes
     * @param array $nodes
     * @param bool $sub
     * @param int $parentDbId
     * @param bool $firstCall
     */
    private function addNodes($nodes = array(), $sub = false, $parentDbId = 0, $firstCall = true)
    {
        foreach ($nodes as $node) {


            if (!$sub) {
                $this->toReturn .= $this->getTabs() . '<tr class="ui-sortable treegrid-'.$node['id'].'" id="sitemap" dbid="' . $parentDbId . '">';
            } else {
                $this->toReturn .= $this->getTabs() . '<tr dbid="' . $parentDbId . '" class="treegrid-'.$node['id'].' treegrid-parent-'.$parentDbId.'">';
            }
            $pagorder = 0;
            if (isset($node['pagorder'])) {
                $pagorder = $node['pagorder'];
            }

            if ($node['status'] == 'restored') {
                $this->hasNodeRestored = true;
            }
            $liAddClass = '';
            if (($this->listDraftContentByPage[$node['id']] > 0)) {
                $liAddClass .= 'draft ';
                $alertContentDraft = ' , Draft: ' . $this->listDraftContentByPage[$node['id']];
            }
            $this->toReturn .=
                '<td
                    class="treegrid-'. $pagorder. ' ' . ($node['ishome'] == 1 ? 'selected' : '') . '"
                    id="' . $node['id'] . '"
                    data="{addClass: \'' . $node['status'] . ' permspicto ' . $this->groups[($node['usersgroups_id'])] . '\',url: \'/adminpages/pages/edit/id/' . $node['id'] . '\',noLink:' . ($this->isRedirected($node) ? 'true' : 'false') . '}"
                    id="structure_' . $node['id'] . '"
                    dbid="' . $node['id'] . '"
                    dborder="' . $pagorder . '">

                        <a href="/adminpages/pages/edit/id/' . $node['id'] . '">'
                            . $node['label'] .
                        '</a>

                    </td>
                    <td class="dynatree-title-detail"><h6 class="text-muted">(Status: ' . $node['status'] .
                ' , View: ' . (int) $node['stats']['views'] . $alertContentDraft;

            $this->toReturn .= ')' . $this->getDataNodeAsHtml($node) . $this->getIshomepageHtml($node['ishome']) . $this->getIsRedirected($node);
            $this->toReturn .= '</h6> </td>';

            // prefix the structure content by action
            $strAction = $this->getActionsHtml($node['id'], $node['ishome'], $node['status'], $node);
            $this->toReturn .= '<td>'.$strAction.'</td>';

            if (!$sub && $this->hasNodeRestored && $node['status'] != 'restored') {
                $this->hasNodeRestored = false;
            }
            $this->toReturn .= '</td>';

            if (count($node['kids']) > 0) {
                $this->addNodes($node['kids'], true, $node['id'], false);
            }

            $this->toReturn .= '</tr>';

        } // END Foreach
    }

    /**
     *
     */
    private function isRedirected($node)
    {
        return (!empty($node['redirecttoid']) && $node['redirecttoid'] != 0);
    }

    /**
     * @param $node
     * @return string
     */
    private function getIsRedirected($node)
    {
        if ($this->isRedirected($node)) {
            return ' <img src="' . $this->view->cdn . '/sydneyassets/images/icons/redirect.png" alt="Page redirected" title="Page redirected" />';
        }
    }

    /**
     * Returns the HTML to mark a node as being the home page
     * @param int $isit
     * @return string
     */
    private function getIshomepageHtml($isit = 0)
    {
        return ($isit == 1) ? '<span class="capsule">Homepage</span>' : '';
    }

    /**
     * Returns end of line and tabs for proper HTML indentation
     * @return String
     */
    private function getTabs()
    {
        $toret = '';
        for ($i = 0; $i <= $this->level; $i++) {
            $toret .= "\t";
        }

        return "\n" . $toret;
    }

    /**
     *
     */
    public function setContext($value)
    {
        if ($value == '') {
            $value = 'default';
        }
        $this->context = $value;
    }

    /**
     *
     */
    public function getContext()
    {
        return $this->context;
    }

    private function getDataNodeAsHtml($node)
    {
        $data = '<div class="tooltip-infos" style="display: none">';
        if (is_array($node['stats']) && count($node['stats']) > 1) {
            $data .= '<b>Views:</b> ' . $node['stats']['views']
                . '<br/><b>Unique:</b> ' . $node['stats']['unique']
                . '<br/><b>Time on page:</b> ' . $node['stats']['timeonpage']
                . '<br/><b>Bounces:</b> ' . $node['stats']['bounces']
                . ' % <br/><b>Exits:</b> ' . $node['stats']['exits']
                . ' % <br/>';
        } else {
            $data .= 'No stats, yet <br/>';
        }
        $data .= '
                <b>Last publication:</b> ' . Sydney_Tools::getDateDashboard($node['datemodified']) . ' <b>by</b> ' . $node['who_modified']
            . '<br/>
                <b>Last update content:</b> ' . Sydney_Tools::getDateDashboard($node['date_lastupdate_content']) . ' <b>by</b> ' . $node['who_lastupdate_content'] . '<br/>
	</div>';

        return $data;
    }

    /**
     * Returns the HTML for the possible action for a node
     *
     *         (
     * [id] => 4031
     * [label] => Welcome in Sydney docs
     * [isCollapsed] =>
     * [status] => published
     * [datemodified] => 2010-11-24 06:38:37
     * [date_lastupdate_content] => 2010-11-24 06:38:37
     * [who_modified] => Gilles Demaret
     * [who_lastupdate_content] => Gilles Demaret
     * [ishome] => 1
     * [iscachable] =>
     * [cachetime] => 0
     * [menusid] => Array
     * (
     * )
     *
     * [redirecttoid] => 0
     * [usersgroups_id] => 2
     * [pagorder] => 0
     * [kids] => Array
     * (
     * )
     *
     * [stats] => Array
     * (
     * )
     *
     * )
     *
     *
     * @return String HTML string
     * @param int $dbid [optional] DB ID of the node
     * @param int $ishome [optional]
     */
    private function getActionsHtml($dbid = 0, $ishome = 0, $status = 'draft', $node = '')
    {
        $btnColor = ($status === 'published') ? 'danger' : 'success';

        $hidit = ($ishome == 1) ? ' invisible' : '';
        $btnStatus = ($status != 'published') ? 'publish' : 'unpublish';
        $toret = '<div id="adminpageaction-' . $dbid . '" class="adminpages_action_container">';
        $toret .= '
        <div class="actionsContainer">
            <span class="actions">
                <a class="button btn btn-sm btn-'.$btnColor.' '. $btnStatus . ' btn-outline" id="btn_publish_' . $dbid . '" dbid="' . $dbid . '">
                    ' . ucfirst($btnStatus) . '
                </a>
                <a title="Add a sub-page" class="button btn btn-sm btn-default btn-outline" href="/adminpages/index/create/parentid/' . $dbid . '">
                    <i class="fa fa-level-down fa-fw"></i>
                </a>
                <a title="Properties" class="button btn btn-sm btn-info btn-outline" href="/adminpages/index/editproperties/id/' . $dbid . '">
                    <i class="fa fa-cogs fa-fw"></i>
                </a>
                <a title="Edit" class="button btn btn-sm btn-primary btn-outline" href="/adminpages/pages/edit/id/' . $node['id'] . '">
                    <i class="fa fa-edit fa-fw"></i>
                </a>
                <a title="Duplicate" class="button duplicate btn btn-sm btn-warning btn-outline" dbid="' . $dbid . '" href="#">
                    <i class="fa fa-copy fa-fw"></i>
                </a>
                <a title="Delete" class="button warning  btn btn-sm btn-danger ' . $hidit . ' deletenodea btn-outline" dbid="' . $dbid . '" href="#">
                    <i class="fa fa-times fa-fw"></i>
                </a>
            </span>
	    </div>';

        $toret .= '</div>';

        return $toret;
    }

}
