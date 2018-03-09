<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Session implements SingletonInterface {

    protected $extension;

    public function setExtension($extension){
        $this->extension = $extension;
    }

    public function get($key) {
        $res = $GLOBALS['TSFE']->fe_user->getKey('ses', $this->extension);
        if ($this->is($extension, $key)) {
            return $res[$key];
        } else {
            return false;
        }
    }

    public function set($key, $value) {
        $res = $this->get($this->extension, $key);
        if (!$res) {
            $res = [];
        }
        $res[$key] = $value;
        $GLOBALS['TSFE']->fe_user->setKey('ses', $this->extension, $res);
        return true;
    }

    public function exists($key) {
        $res = $this->get($this->extension, $key);
        if (isset($res[$key])) {
            return true;
        } else {
            return false;
        }
    }

}