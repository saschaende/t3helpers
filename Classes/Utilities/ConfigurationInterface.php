<?php

namespace SaschaEnde\T3helpers\Utilities;

interface ConfigurationInterface {

    /**
     * @param $ext
     * @return $this
     */
    public function setExtension($ext);
    public function get($propertyName);
    public function getAll();

}