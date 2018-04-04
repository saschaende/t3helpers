<?php

namespace SaschaEnde\T3helpers\Utilities;

interface CategoryInterface {

    /**
     * @param $categories
     * @param string $delimiter
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function getByString($categories, $delimiter = ',');

}