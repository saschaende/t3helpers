<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Session implements SingletonInterface {

    public function get($extension, $key) {
        $res = $GLOBALS['TSFE']->fe_user->getKey('ses', $extension);
        if ($this->is($extension, $key)) {
            return $res[$key];
        } else {
            return false;
        }
    }

    public function set($extension, $key, $value) {
        $res = $this->get($extension, $key);
        if (!$res) {
            $res = [];
        }
        $res[$key] = $value;
        $GLOBALS['TSFE']->fe_user->setKey('ses', $extension, $res);
        return true;
    }

    public function is($extension, $key) {
        $res = $this->get($extension, $key);
        if (isset($res[$key])) {
            return true;
        } else {
            return false;
        }
    }

}