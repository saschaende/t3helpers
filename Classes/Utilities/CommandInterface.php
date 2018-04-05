<?php

namespace SaschaEnde\T3helpers\Utilities;

/**
 * Interface ConfigurationInterface
 * @package SaschaEnde\T3helpers\Utilities
 * @ignore
 */
interface CommandInterface {

    /**
     * Call this in "ext_localconf.php"
     * @param $class
     */
    public function register($class);

}