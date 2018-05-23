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

    /**
     * Create an array from xml string - cause GeneralUtility::xml2array is buggy with some xml structures
     * @param $xmldata
     * @return \t3h\DOMDocument
     */
    public function xmlToArray($xmldata);
}