<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DataInterface {
    public function sortArray($arr, $fields);
    public function arrayToObject($array);
}