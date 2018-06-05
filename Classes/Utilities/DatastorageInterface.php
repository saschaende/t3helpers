<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DatastorageInterface {


    /**
     * @param $extension
     * @return $this
     */
    public function extension($extension);

    /**
     * @param $key
     * @param $data
     */
    public function set($key,$data);


    /**
     * @param $key
     * @param $data
     * @return mixed|bool
     */
    public function get($key,$data);

    /**
     * @param $key
     * @return bool
     */
    public function exists($key);
}