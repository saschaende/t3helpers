<?php

namespace SaschaEnde\T3helpers\Utilities;


use TYPO3\CMS\Core\SingletonInterface;

class Website implements SingletonInterface {

    /**
     * Frontend: Get current Website Root PID
     * @return mixed
     */
    public function getWebsiteRootPid(){
        return $GLOBALS['TSFE']->rootLine[0]['uid'];
    }

}