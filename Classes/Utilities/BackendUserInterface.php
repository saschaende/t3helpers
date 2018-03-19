<?php

namespace SaschaEnde\T3helpers\Utilities;

interface  BackendUserInterface {

    public function __construct();
    public function get();
    public function getGroups();
    public function getAllowedPages();
}