<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Configuration\ConfigurationManager;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

// Perhaps the better way now (TYPO3 8):
///** @var \TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility $configurationUtility */
//$configurationUtility = $this->objectManager->get('TYPO3\CMS\Extensionmanager\Utility\ConfigurationUtility');
//$extensionConfiguration = $configurationUtility->getCurrentConfiguration('abc_extension');

/**
 * Class Configuration
 * @package SaschaEnde\T3helpers\Utilities
 * @ignore
 */
class Configuration implements SingletonInterface {

    private $configurationManager;
    private $extensionConfiguration;
    private $ext;


    /**
     * @param $ext
     */
    public function setExtension($ext) {
        $this->ext = $ext;
        $this->configurationManager = t3h::injectClass(ConfigurationManager::class);
        $this->extensionConfiguration = unserialize($this->configurationManager->getConfigurationValueByPath('EXT/extConf/' . $ext));
    }

    /**
     * @param $propertyName
     * @return mixed
     * @throws \TYPO3\CMS\Core\Exception
     */
    public function get($propertyName) {
        if (array_key_exists($propertyName, $this->extensionConfiguration) === FALSE || $this->extensionConfiguration[$propertyName] == '') {
            throw new \TYPO3\CMS\Core\Exception('"' . $propertyName . '" must be configured in the ExtensionManager (EXT:' . $this->ext . ')', 1380287842);
        }
        return $this->extensionConfiguration[$propertyName];
    }

    /**
     * @return mixed
     */
    public function getAll() {
        return t3h::Data()->arrayToObject($this->extensionConfiguration);
    }
}