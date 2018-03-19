<?php

namespace SaschaEnde\T3helpers\Utilities;

interface PageInterface {

    public function getTitle();
    public function getPid();
    public function getPagetree($topId, $depth = 1);
}