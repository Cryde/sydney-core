<?php
require_once('Zend/View/Helper/Abstract.php');

/**
 * Helper showing the structure of a site in edit mode.
 * This is used in the module page -> structure editor
 *
 * @package SydneyLibrary
 * @subpackage ViewHelper
 * @author Arnaud Selvais
 * @since 31/05/09
 * @todo Implement the translation method here
 */
class Sydney_View_Helper_Dashboard extends Zend_View_Helper_Abstract
{
    /**
     * Helper main function
     * @return String HTML to be inserted in the view
     * @param Array $structureArray [optional] Structure in an array form
     */
    public function Dashboard($listactivities)
    {
        $html = '';
        $invertedCpt = 1;
        foreach ($listactivities['time'] as $datetime => $activityListId) {

            $cssClass = ($invertedCpt % 2 === 0)? 'timeline-inverted' :'';
            foreach ($activityListId as $activityId) {
                $html .= '
                <li class="'.$cssClass.'">
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4>'.$listactivities['datas'][$activityId]->fname . ' ' . $listactivities['datas'][$activityId]->lname.'
                            </h4>
                            <p>
                                <small class="text-muted">
                                    <i class="fa fa-clock-o"></i> '.
                                    $datetime.' '.Sydney_Tools::getTime($listactivities['datas'][$activityId]->timestamp)
                                .'</small>
                            </p>
                        </div>
                        <div class="timeline-body"><p>';

                $html .= '
'.$listactivities['datas'][$activityId]->cnt . ' ' . Sydney_Tools::_('trace.event.action.' . $listactivities['datas'][$activityId]->action);

                $html .= '</p></div></div><div class="timeline-badge primary">
<i class="fa fa-check"></i></div></li>';

                //$currentModuleNameFormated = $listactivities['datas'][$activityId]->module . '-' . $listactivities['datas'][$activityId]->module_table . '-' . $listactivities['datas'][$activityId]->action;

                // MAEL NOTE : a garder pour le futur switch case  echo $currentModuleNameFormated . ' ';

            }
            $invertedCpt++;
        }

        return $html;
    }

}
