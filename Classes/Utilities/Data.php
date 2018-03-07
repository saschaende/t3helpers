<?php

namespace SaschaEnde\T3helpers\Utilities;

class Data {

    public static function sortArray($arr, $fields) {
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

    public static function arrayToObject($array){
        $obj = new \stdClass();
        foreach($array as $key=>$value){
            $obj->{$key} = $value;
        }
        return $obj;
    }
}