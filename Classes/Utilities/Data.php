<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Data implements SingletonInterface {

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

    public function sortArray($arr, $fields) {
        $sortFields = array();
        $args = array();

        foreach ($arr as $key => $row) {
            foreach ($fields as $field => $order) {
                $sortFields[$field][$key] = trim($row[$field]);
            }
        }

        foreach ($fields as $field => $order) {
            $args[] = $sortFields[$field];

            if (is_array($order)) {
                foreach ($order as $pt) {
                    $args[$pt];
                }
            } else {
                $args[] = ($order == 'asc') ? SORT_ASC : SORT_DESC;
            }
        }

        $args[] = &$arr;

        call_user_func_array('array_multisort', $args);

        return $arr;
    }

    public function arrayToObject($array) {
        $obj = new \stdClass();
        foreach ($array as $key => $value) {
            $obj->{$key} = $value;
        }
        return $obj;
    }
}