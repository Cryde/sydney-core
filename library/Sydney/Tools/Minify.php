<?php

/**
 * Utilities for minifying JS and concatanate...
 *
 */
class Sydney_Tools_Minify extends Sydney_Tools
{

    /**
     *
     * @param unknown_type $type
     * @param Zend_View $zview
     * @param unknown_type $useCompression
     * @param unknown_type $useConcatenation
     * @param unknown_type $ctrl
     */
    public static function concatScripts($type, Zend_View $zview, $useConcatenation = true)
    {
        return self::concatJs();
    }


    private static function concatJs(){

        $modulesCorePath = Sydney_Tools::getRootPath() . '/core/application/modules/';
        $jsAssetsRessources = '/ressources/assets/private/js/';

        $dirList = self::getDirList($modulesCorePath);

        $strFiles = '';
        foreach($dirList as $dirModule){
            $jsFolderPath = $modulesCorePath.$dirModule.$jsAssetsRessources;
            if(file_exists($jsFolderPath)){
                $files = self::getDirList($jsFolderPath);
                foreach ($files as $file) {
                    $jsFilePath = $jsFolderPath . $file;
                    $strFiles .= "/* == File: " . $jsFilePath . " == */ \n\n" . file_get_contents($jsFilePath) . "\n\n";
                }
            }
        }

        return $strFiles;
    }
}
