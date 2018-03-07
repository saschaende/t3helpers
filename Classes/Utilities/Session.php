<?php

namespace SaschaEnde\T3helpers\Utilities;

class Session {

    public static function get($extension,$key){
        $res = $GLOBALS['TSFE']->fe_user->getKey('ses', $extension);
        if(self::is($extension,$key)){
            return $res[$key];
        }else{
            return false;
        }
    }

    public static function set($extension,$key,$value){
        $res = self::get($extension,$key);
        if(!$res){
            $res = [];
        }
        $res[$key] = $value;
        $GLOBALS['TSFE']->fe_user->setKey('ses', $extension, $res);
        return true;
    }

    public static function is($extension,$key){
        $res = self::get($extension,$key);
        if(isset($res[$key])){
            return true;
        }else{
            return false;
        }
    }

}