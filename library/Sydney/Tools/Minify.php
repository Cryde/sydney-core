<?php

/**
 * Utilities for minifying JS and concatanate...
 *
 */
class Sydney_Tools_Minify extends Sydney_Tools
{

    /**
     * @return string
     */
    public static function concatScripts()
    {
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

    /**
     * @return string
     */
    public static function concatCss(){
        $modulesCorePath = Sydney_Tools::getRootPath() . '/core/application/modules/';
        $jsAssetsRessources = '/ressources/assets/private/css/';

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
