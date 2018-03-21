<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Database implements SingletonInterface {

    public function querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false) {

        /** @var Typo3QuerySettings $querySettings */
        $querySettings = t3h::injectClass(Typo3QuerySettings::class);

        $querySettings->setRespectStoragePage($setRespectStoragePage);
        $querySettings->setIgnoreEnableFields($setIgnoreEnableFields);
        $querySettings->setIncludeDeleted($setIncludeDeleted);

        return $querySettings;
    }

    public function truncateTable($table) {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
        $connection->truncate($table);
    }

    public function convertQueryResultToObjectStorage($queryResult){
        $object = new ObjectStorage();
        foreach($queryResult as $q){
            $object->attach($q);
        }
        return $object;
    }

}