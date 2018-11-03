<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Database implements DatabaseInterface, SingletonInterface {

    /**
     * @param bool $setRespectStoragePage
     * @param bool $setIgnoreEnableFields
     * @param bool $setIncludeDeleted
     * @return Typo3QuerySettings
     */
    public function getQuerySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false) {

        /** @var Typo3QuerySettings $querySettings */
        $querySettings = t3h::injectClass(Typo3QuerySettings::class);

        $querySettings->setRespectStoragePage($setRespectStoragePage);
        $querySettings->setIgnoreEnableFields($setIgnoreEnableFields);
        $querySettings->setIncludeDeleted($setIncludeDeleted);

        return $querySettings;
    }

    /**
     * @param $table
     */
    public function truncateTable($table) {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable($table);
        $connection->truncate($table);
    }

    /**
     * @param $queryResult
     * @return ObjectStorage
     */
    public function getObjectStorageByQueryResult($queryResult){
        $object = new ObjectStorage();
        foreach($queryResult as $q){
            $object->attach($q);
        }
        return $object;
    }

    /**
     * @param $table
     * @param $addFrom
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    public function getQuerybuilder($table, $addFrom = true){
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        if($addFrom){
            $queryBuilder->from($table);
        }
        return $queryBuilder;
    }

    /**
     * Persist All
     */
    public function persistAll(){
        $persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
        $persistenceManager->persistAll();
    }

}