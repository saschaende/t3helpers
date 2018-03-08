<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DatabaseInterface {
    public function querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false);
    public function truncateTable($table);
}