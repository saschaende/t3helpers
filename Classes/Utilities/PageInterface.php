<?php

namespace SaschaEnde\T3helpers\Utilities;

interface PageInterface {

    /**
     * @return mixed|string
     */
    public function getTitle();

    /**
     * @return mixed
     */
    public function getPid();

    /**
     * @param $topId
     * @param int $depth
     * @return array
     */
    public function getPagetree($topId, $depth = 1);
}