<?php

namespace SaschaEnde\T3helpers\Utilities;


use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Debug implements SingletonInterface {

    public function output($data) {
        DebuggerUtility::var_dump($data);
    }

    public function mailoutput($fromEmail, $recipientEmail, $data) {
        \T3h\Mail()->send(
            $recipientEmail,
            $fromEmail,
            'Debugger',
            'Debug Output',
            print_r($data, true)
        );
    }

    public function debugFullTyposcript() {
        $configurationManager = \T3h\injectClass(ConfigurationManager::class);
        $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $this->output($extbaseFrameworkConfiguration);
    }

}