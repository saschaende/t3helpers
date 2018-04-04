<?php

$temporaryColumns = [
    'crdate' => [
        'exclude' => 1,
        'label' => 'Erstellzeitpunkt',
        'config' => [
            'type' => 'input',
            'size' => '13',
            'eval' => 'datetime',
            'default' => '0',
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'pages',
    $temporaryColumns
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    'crdate',
    '',
    'before:subtitle'
);