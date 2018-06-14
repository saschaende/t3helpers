<?php

namespace SaschaEnde\T3helpers\Examples;

use SaschaEnde\T3helpers\Ajax\AbstractEid;

class EidExample extends AbstractEid {

    public function initializeAction() {
        echo "<p>This will be executed everytime!</p>";
    }

    /**
     * https://www.website.com/?eID=t3h_example&action=first
     */
    public function firstAction() {
        echo "<p>firstAction</p>";
    }

    /**
     * https://www.website.com/?eID=t3h_example&action=second
     */
    public function secondAction() {
        echo "<p>secondAction</p>";
    }

}

global $TYPO3_CONF_VARS;
/** @var eID $eid */
$eid = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(EidExample::class, $TYPO3_CONF_VARS);

