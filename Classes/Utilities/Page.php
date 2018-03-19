<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Database\QueryGenerator;

class Page  implements SingletonInterface {

    public function getPid(){
        return $GLOBALS['TSFE']->id;
    }

    public function getTitle(){
        $arr  = $GLOBALS['TSFE']->rootLine;
        $titlArr = array_shift(array_values( $arr ));
        return $titlArr['title'];
    }

    public function getPagetree($topId, $depth = 1){
        $queryGenerator = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(QueryGenerator::class);
        return explode(',',$queryGenerator->getTreeList($topId, $depth, 0, 1));
    }

}