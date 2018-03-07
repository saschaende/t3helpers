<?php

// I cant explain the exact sematics very well, but you will want to have both.
// Otherwise your classes wont load in a cached context.

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$composerAutoloadFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY)
    . 'Resources/Private/Libraries/t3helpers.php';

require_once($composerAutoloadFile);