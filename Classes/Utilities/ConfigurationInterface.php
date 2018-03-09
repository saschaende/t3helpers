<?php

namespace SaschaEnde\T3helpers\Utilities;

/**
 * Interface ConfigurationInterface
 * @package SaschaEnde\T3helpers\Utilities
 * @ignore
 */
interface ConfigurationInterface {

    /**
     * @param $ext
     * @return $this
     */
    public function setExtension($ext);
    public function get($propertyName);
    public function getAll();

}