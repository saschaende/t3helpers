<?php

namespace SaschaEnde\T3helpers\Utilities;

interface SessionInterface {

    /**
     * @param $extension
     * @return $this
     */
    public function setExtension($extension);
    public function get($key = null);
    public function remove($key = null);
    public function set($key, $value);
    public function exists($key);

}