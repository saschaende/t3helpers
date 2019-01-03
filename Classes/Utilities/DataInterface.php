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


    /**
     * @param $data
     * @param string $rootNodeName
     * @param null $xml
     * @return mixed
     */
    public function arrayToXml($data, $rootNodeName = 'data', $xml=null);

    /**
     * Format html code with RTE features
     * @param $str
     * @return string
     */
    public function formatRTE($str);

    /**
     * automatic convertion windows-1250 and iso-8859-2 info utf-8 string
     * @param   string  $s
     * @return  string
     */
    public function autoUTF($s);

    /**
     * @param $url
     * @return mixed
     */
    public function get_youtube_id_from_url($url);

    /**
     * Extended version of parse_url
     * @param $url
     */
    public function parse_url($url);

}