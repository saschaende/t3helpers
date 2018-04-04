<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;

class Category implements SingletonInterface {

    /**
     * CategoryRepository
      * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     */
    protected $categoryRepository;

    public function __construct() {
        $this->categoryRepository = t3h::injectClass(CategoryRepository::class);
    }

    /**
     * @param $categories
     * @param string $delimiter
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function getByString($categories, $delimiter = ','){
        $query = $this->categoryRepository->createQuery();
        $query->matching($query->in('uid',explode($delimiter,$categories)));
        return $query->execute();
    }

}