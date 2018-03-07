<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class Settings {

    /**
     * DebuggerUtility::var_dump($this->getExtensionSettings('SemMyextension','pluginname'));
     * @param $extensionName underscoredToUpperCamelCase
     * @param $pluginName strtolower
     * @return array
     */
    public static function getPlugin($extensionName, $pluginName) {
        $pluginName = strtolower($pluginName);
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        /** @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager */
        $configurationManager = $objectManager->get(ConfigurationManagerInterface::class);
        $settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            $extensionName,
            $pluginName
        );
        return $settings;
    }


}