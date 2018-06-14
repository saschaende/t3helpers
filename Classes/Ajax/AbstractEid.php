<?php

namespace SaschaEnde\T3helpers\Ajax;


class AbstractEid {
    /**
     * @var \array
     */
    protected $configuration = [];

    /**
     * @var \array
     */
    protected $bootstrap;

    /**
     * Initialize Extbase
     *
     * @param \array $TYPO3_CONF_VARS
     */
    public function __construct($TYPO3_CONF_VARS) {

        // create bootstrap
        $this->bootstrap = new \TYPO3\CMS\Extbase\Core\Bootstrap();

        // get User
        $feUserObj = \TYPO3\CMS\Frontend\Utility\EidUtility::initFeUser();

        // set PID
        $pid = (\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id')) ? \TYPO3\CMS\Core\Utility\GeneralUtility::_GET('id') : 1;

        // Create and init Frontend
        $GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController', $TYPO3_CONF_VARS, $pid, 0, TRUE);
        $GLOBALS['TSFE']->connectToDB();
        $GLOBALS['TSFE']->fe_user = $feUserObj;
        $GLOBALS['TSFE']->id = $pid;
        $GLOBALS['TSFE']->determineId();
        if (\TYPO3\CMS\Core\Utility\GeneralUtility::_GET('L')) {
            $GLOBALS['TSFE']->sys_language_uid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GET('L');
        }
        $GLOBALS['TSFE']->settingLanguage();
        $GLOBALS['TSFE']->settingLocale();
        #$GLOBALS['TSFE']->getCompressedTCarray(); //Comment this line when used for TYPO3 7.6.0 on wards
        $GLOBALS['TSFE']->initTemplate();
        $GLOBALS['TSFE']->getConfigArray();
        #$GLOBALS['TSFE']->includeTCA(); //Comment this line when used for TYPO3 7.6.0 on wards
        // pxc MA wir muessen noch ein cObj initialisieren, damit fluid links funktionieren
        $GLOBALS['TSFE']->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

        /**
         * @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager
         */
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');

        // Init
        if (method_exists($this, 'initializeAction')) {
            $this->initializeAction();
        }

        // Execute Get
        $m = $_REQUEST['action'] . 'Action';
        if (method_exists($this, $m)) {
            $this->{$m}();
        }
    }

    public function __destruct() {
        # Den Vorschlaghammer instanzieren / aus der Kiste kramen
        $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");

        # Mit dem Vorschlaghammer in die Datenbank speichern / Nägel mit Köpfen machen
        $persistenceManager->persistAll();
    }


}