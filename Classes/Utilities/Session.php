<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Session implements SingletonInterface {

    protected $extension;
    protected $sessiondata = [];

    public function setExtension($extension){
        $this->extension = $extension;
        if(!isset($this->sessiondata[$this->extension])){
            $res = $GLOBALS['TSFE']->fe_user->getKey('ses', $this->extension);
            if($res){
                $this->sessiondata[$this->extension] = $res;
            }else{
                $this->sessiondata[$this->extension] = [];
            }
        }
        return $this;
    }

    public function get($key) {
        if (isset($this->sessiondata[$this->extension]) && isset($this->sessiondata[$this->extension][$key])) {
            return $this->sessiondata[$this->extension][$key];
        } else {
            return false;
        }
    }

    public function set($key, $value) {
        $this->sessiondata[$this->extension][$key] = $value;
        $GLOBALS['TSFE']->fe_user->setKey('ses', $this->extension, $this->sessiondata[$this->extension]);
    }

    public function exists($key) {
        if (isset($this->sessiondata[$this->extension][$key])) {
            return true;
        } else {
            return false;
        }
    }

}