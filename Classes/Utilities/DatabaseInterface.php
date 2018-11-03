<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DatabaseInterface {

    /**
     * @param bool $setRespectStoragePage
     * @param bool $setIgnoreEnableFields
     * @param bool $setIncludeDeleted
     * @return Typo3QuerySettings
     */
    public function getQuerySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false);

    /**
     * @param $table
     */
    public function truncateTable($table);

    /**
     * @param $queryResult
     * @return ObjectStorage
     */
    public function getObjectStorageByQueryResult($queryResult);

    /**
     * @param $table
     * @param $addFrom
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    public function getQuerybuilder($table, $addFrom = true);

    /**
     * Persist All
     */
    public function persistAll();
}