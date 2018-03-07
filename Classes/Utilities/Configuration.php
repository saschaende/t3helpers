<?php

namespace SaschaEnde\T3helpers\Utilities;

/**
 * Konfigurations Einstellungen laden
 *
 * @author pn
 */
class Configuration {

    private static $configurationManager;
    private static $extensionConfiguration;
    private static $ext;

    /**
     * constructor
     *
     * will read in and unserialze the config as set by EM
     */
    public static function setExtension($ext) {
        self::$ext = $ext;
        self::$configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Configuration\ConfigurationManager');
        self::$extensionConfiguration = unserialize(self::$configurationManager->getConfigurationValueByPath('EXT/extConf/'.$ext));
    }

    public static function get($propertyName) {
        if (array_key_exists($propertyName, self::$extensionConfiguration) === FALSE || self::$extensionConfiguration[$propertyName] == '') {
            throw new \TYPO3\CMS\Core\Exception('"' . $propertyName . '" must be configured in the ExtensionManager (EXT:'.self::$ext.')', 1380287842);
        }
        return self::$extensionConfiguration[$propertyName];
    }

    public static function getAll() {
        return Data::arrayToObject(self::$extensionConfiguration);
    }
}