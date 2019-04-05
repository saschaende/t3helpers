<?php

// I cant explain the exact sematics very well, but you will want to have both.
// Otherwise your classes wont load in a cached context.

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$composerAutoloadFile = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY)
    . 'Resources/Private/Libraries/t3helpers.php';

require_once($composerAutoloadFile);


// Add admin module
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'SaschaEnde.t3helpers',
    'tools', // Make module a submodule of 'tools'
    't3hdocs', // Submodule key
    '', // Position
    [
        'Apidocs' => 'list,markdown',
    ],
    [
        'access' => 'user,group',
        'icon'   => 'EXT:t3helpers/Resources/Public/Icons/Extension.png',
        'labels' => 'LLL:EXT:t3helpers/Resources/Private/Language/locallang_docs.xlf',
    ]
);