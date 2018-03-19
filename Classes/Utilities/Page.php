<?php

namespace SaschaEnde\T3helpers\Utilities;

class Page  implements SingletonInterface {

    public function getPid(){
        return $GLOBALS['TSFE']->id;
    }

    public function getTitle(){
        $arr  = $GLOBALS['TSFE']->rootLine;
        $titlArr = array_shift(array_values( $arr ));
        return $titlArr['title'];
    }

}