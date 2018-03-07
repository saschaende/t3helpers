<?php

namespace SaschaEnde\T3helpers\Utilities;

class Injections {

    public static function phpFile($extension,$path){
        $filePath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY)
            . $path;
        require_once($filePath);
    }

}