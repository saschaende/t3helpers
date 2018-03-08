<?php

namespace SaschaEnde\T3helpers\Utilities;

interface ConfigurationInterface {

    public function setExtension($ext);
    public function get($propertyName);
    public function getAll();

}