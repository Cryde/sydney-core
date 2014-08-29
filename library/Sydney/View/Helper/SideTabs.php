<?php
require_once('Zend/View/Helper/Abstract.php');

class Sydney_View_Helper_SideTabs extends Zend_View_Helper_Abstract
{
    /**
     *
     * Helper for displaying tabs and buttons in a sidebar in sydney admin
     *
     * @param Array $module Array of actions and their labels to show in the tabs
     * @param String $exceptAction Label of an action where we should not show the add button (like an index -> dashboard for example)
     * @param String $cdn The CDN to be used
     * @param String $moduleName The name of the module
     * @param String $controllerName The name of the Controller
     * @param String $currentActionName The name of the current action (to highlight the tab)
     * @return String The resulting HTML
     */
    public function SideTabs($module, $exceptAction, $cdn, $moduleName, $controllerName, $currentActionName, $parameters = false)
    {
        $html = '<ul class="nav nav-tabs">';
        foreach ($module as $actionName => $v) {
            if (preg_match('/^sep[0-9]{0,5}$/', $actionName)) {
                $html .= '</ul><div class="pod"><h2>' . Sydney_Tools_Localization::_($v) . '</h2></div><ul id="localnav" class="clearfix">';
            } else {
                $isActive = '';
                if ($currentActionName == $actionName) {
                    $isActive = 'active';
                }
                $html .= '<li class="' . $isActive . '">
                            <a href="/' . $moduleName . '/' . $controllerName . '/' . $actionName . '">'
                                . Sydney_Tools_Localization::_($v) . '
                            </a>
                         </li>';
            }
        }
        $html .= '</ul>';

        return $html;
    }

}
