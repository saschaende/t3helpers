<?php

namespace SaschaEnde\T3helpers\Utilities;

interface SessionInterface {

    public function get($extension, $key);
    public function set($extension, $key, $value);
    public function is($extension, $key);

}