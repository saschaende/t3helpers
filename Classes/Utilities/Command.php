<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Command implements SingletonInterface {

    /**
     * Call this in "ext_localconf.php"
     * @param $class
     */
    public function register($class){
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = $class;
    }

}