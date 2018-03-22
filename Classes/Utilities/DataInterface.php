<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

interface DataInterface {

    public function sortObjectStorage(ObjectStorage $object, $function, $ordering = 'asc');
    public function sortArray($arr, $fields);
    public function arrayToObject($array);
}