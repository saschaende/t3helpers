<?php

namespace SaschaEnde\T3helpers\Traits;

use t3h\t3h;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper;

trait DynamicProperties {
    /**
     * Get non existent properties
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \TYPO3\CMS\Extbase\Persistence\Generic\Exception
     */
    public function __call($name, $arguments)
    {
        if(!isset($this->rawDataArray)){
            // Get the table name
            /** @var DataMapper $dataMapper */
            $dataMapper = t3h::injectClass(\TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper::class);
            $tableName = $dataMapper->getDataMap(get_class($this))->getTableName();

            // Get the field name
            $name = substr($name,3);
            $fieldName = GeneralUtility::camelCaseToLowerCaseUnderscored($name);

            // Make a database query to get the full raw data
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($tableName);
            $res = $queryBuilder->select('*')
                ->from($tableName)
                ->where(
                    $queryBuilder->expr()->eq('uid', $this->getUid())
                );
            $this->rawDataArray = $res->execute()->fetch();
        }

        if(isset($this->rawDataArray[$fieldName])){
            return $this->rawDataArray[$fieldName];
        }else{
            return null;
        }
    }
}