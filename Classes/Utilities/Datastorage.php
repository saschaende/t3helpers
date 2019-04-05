<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

/**
 * A temporary data storage for one page impression. Set variables and use them in other extensions, viewhelpers... A cleaner way instead of using global variables.
 * @package SaschaEnde\T3helpers\Utilities
 */
class Datastorage implements SingletonInterface {

    protected $Data = [];
    protected $extension = '';

    /**
     * Set an extension name first
     * @param $extension
     * @return $this
     */
    public function extension($extension) {
        $this->extension = $extension;
        return $this;
    }

    /**
     * Set data
     * @param $key
     * @param $data
     */
    public function set($key, $data) {
        $this->Data[$this->extension][$key] = $data;
    }


    /**
     * Get data for a key
     * @param $key
     * @return mixed|bool
     */
    public function get($key) {
        if ($this->exists($key)) {
            return $this->Data[$this->extension][$key];
        } else {
            return false;
        }
    }

    /**
     * Check if data for this key exists
     * @param $key
     * @return bool
     */
    public function exists($key) {
        return isset($this->Data[$this->extension][$key]);
    }


}