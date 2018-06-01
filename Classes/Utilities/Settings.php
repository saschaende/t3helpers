<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class Settings implements SingletonInterface {

    /**
     * @param $extensionName
     * @param string $part
     * @return mixed
     */
    public function getExtension($extensionName, $part = 'settings'){
        $ts = $this->getFullTyposcript();
        return $ts['plugin.'][$extensionName.'.'][$part.'.'];
    }

    public function getPlugin($extensionName, $pluginName = null) {
        if($pluginName != null){
            $pluginName = strtolower($pluginName);
        }
        /** @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface $configurationManager */
        $configurationManager = t3h::injectClass(ConfigurationManagerInterface::class);

        $settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            $extensionName,
            $pluginName
        );
        return $settings;
    }

    public function getFullTyposcript(){
            $configurationManager = t3h::injectClass(ConfigurationManager::class);
            $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
            return $extbaseFrameworkConfiguration;
    }


}