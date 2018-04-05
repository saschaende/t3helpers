<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Page implements SingletonInterface {

    /**
     * @return mixed|string
     */
    public function getPid() {
        return $GLOBALS['TSFE']->id;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        $arr = $GLOBALS['TSFE']->rootLine;
        $titlArr = array_shift(array_values($arr));
        return $titlArr['title'];
    }

    /**
     * @param $topId
     * @param int $depth
     * @return array
     */
    public function getPagetree($topId, $depth = 1000000) {
        /** @var QueryGenerator $queryGenerator */
        $queryGenerator = t3h::injectClass(QueryGenerator::class);
        $res = explode(',',$queryGenerator->getTreeList($topId, $depth, 0, 1));
        // Entferne den Startpunkt
        unset($res[array_search($topId, $res)]);
        // Return
        return $res;
    }

}