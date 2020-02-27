<?php

// I cant explain the exact sematics very well, but you will want to have both.
// Otherwise your classes wont load in a cached context.

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/Libraries/t3helpers.php');
require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Resources/Private/vendor/autoload.php');

// eID Dispatcher
// $TYPO3_CONF_VARS['FE']['eID_include']['t3h_example'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3helpers') . 'Classes/Examples/EidExample.php';

// Add viewhelper namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['t3h'] = ['SaschaEnde\\T3helpers\\ViewHelpers'];