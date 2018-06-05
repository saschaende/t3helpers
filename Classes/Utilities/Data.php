<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use t3h\XML2Array;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Data implements DataInterface, SingletonInterface {

    /**
     * Example: t3h::Data()->sortObjectStorage($users,'getUsername','asc')
     * @param ObjectStorage $object
     * @param $function
     * @param string $ordering
     * @return ObjectStorage
     */
    public function sortObjectStorage(ObjectStorage $object, $function, $ordering = 'asc'){
        $array = [];
        foreach($object as $elm){
            $array[] = [
                'object'    =>  $elm,
                'sort'   =>  $elm->$function()
            ];
        }
        $array = $this->sortArray($array,['sort'=>$ordering]);

        $storage = new ObjectStorage();
        foreach($array as $elm){
            $storage->attach($elm['object']);
        }
        return $storage;
    }

    /**
     * @param $arr
     * @param $fields
     * @return mixed
     */
    public function sortArray($arr, $fields) {
        $sortFields = array();
        $args = array();

        foreach ($arr as $key => $row) {
            foreach ($fields as $field => $order) {
                $sortFields[$field][$key] = $row[$field];
            }
        }

        foreach ($fields as $field => $order) {
            $args[] = $sortFields[$field];

            if (is_array($order)) {
                foreach ($order as $pt) {
                    $args[$pt];
                }
            } else {
                $args[] = ($order == 'asc' || $order == 'ASC' || $order == SORT_ASC) ? SORT_ASC : SORT_DESC;
            }
        }

        $args[] = &$arr;

        call_user_func_array('array_multisort', $args);

        return $arr;
    }

    /**
     * @param $array
     * @return \stdClass
     */
    public function arrayToObject($array) {
        $obj = new \stdClass();
        foreach ($array as $key => $value) {
            $obj->{$key} = $value;
        }
        return $obj;
    }

    /**
     * Create an array from xml string - cause GeneralUtility::xml2array is buggy with some xml structures
     * @param $xmldata
     * @return \t3h\DOMDocument
     */
    public function xmlToArray($xmldata){
        t3h::Inject()->setExtension('t3helpers')->phpFile('Resources/Private/Libraries/XML2Array.php');
        return XML2Array::createArray($xmldata);
    }
}