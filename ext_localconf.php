<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// I cant explain the exact sematics very well, but you will want to have both.
// Otherwise your classes wont load in a cached context.

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


(function () {
        if (!\TYPO3\CMS\Core\Core\Environment::isComposerMode()) {
            	require_once(ExtensionManagementUtility::extPath('t3helpers') . 'Resources/Private/Libraries/t3helpers.php');
		require_once(ExtensionManagementUtility::extPath('t3helpers') . 'Resources/Private/vendor/autoload.php');

		// eID Dispatcher
		// $TYPO3_CONF_VARS['FE']['eID_include']['t3h_example'] = ExtensionManagementUtility::extPath('t3helpers') . 'Classes/Examples/EidExample.php';

		// Add viewhelper namespace
		$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t3h'] = ['SaschaEnde\\T3helpers\\ViewHelpers'];
        }
    }
})();
