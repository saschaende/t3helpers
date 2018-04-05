<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

interface DataInterface {

    /**
     * Example: t3h::Data()->sortObjectStorage($users,'getUsername','asc')
     * @param ObjectStorage $object
     * @param $function
     * @param string $ordering
     * @return ObjectStorage
     */
    public function sortObjectStorage(ObjectStorage $object, $function, $ordering = 'asc');

    /**
     * @param $arr
     * @param $fields
     * @return mixed
     */
    public function sortArray($arr, $fields);

    /**
     * @param $array
     * @return \stdClass
     */
    public function arrayToObject($array);
}