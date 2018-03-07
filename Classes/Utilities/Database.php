<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

class Database {

    public static function querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false) {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $querySettings = $objectManager->get(Typo3QuerySettings::class);

        $querySettings->setRespectStoragePage($setRespectStoragePage);
        $querySettings->setIgnoreEnableFields($setIgnoreEnableFields);
        $querySettings->setIncludeDeleted($setIncludeDeleted);

        return $querySettings;
    }

    public static function truncateTable($table) {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
        $connection->truncate($table);
    }

}