<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DatabaseInterface {
    public function getQuerySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false);
    public function truncateTable($table);
    public function getObjectStorageByQueryResult($queryResult);
}