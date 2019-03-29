<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Datastorage implements SingletonInterface {

    protected $Data = [];
    protected $extension = '';

    /**
     * @param $extension
     * @return $this
     */
    public function extension($extension){
        $this->extension = $extension;
        return $this;
    }

    /**
     * @param $key
     * @param $data
     */
    public function set($key,$data){
        $this->Data[$this->extension][$key] = $data;
    }


    /**
     * @param $key
     * @param $data
     * @return mixed|bool
     */
    public function get($key,$data){
        if($this->exists($key)){
            return $this->Data[$this->extension][$key];
        }else{
            return false;
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function exists($key){
        return isset($this->Data[$this->extension][$key]);
    }


}