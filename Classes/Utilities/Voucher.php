<?php

namespace SaschaEnde\T3helpers\Utilities;


class Voucher {

    private static $key = '3PFQHN964Y1BRTAX7WSCUZG8M2ED5LV';

    public static function setBase($base){
        self::$key = $base;
    }

    public static function encode($num) {

        $num = $num+1000;

        $base = strlen(self::$key);
        $index = substr(self::$key, 0, $base);

        $out = "";
        for ($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
            $a = floor($num / pow($base, $t));
            $out = $out.substr($index, $a, 1);
            $num = $num - ($a * pow($base, $t));
        }

        $result = strrev($out);

        $randomstring = self::generateBase();

        $export = [];
        $export[] = $result;

        $pos = 0;
        for($i=1;$i<=3;$i++){
            $export[] = substr($randomstring,$pos,strlen($result));
            $pos += strlen($result);
        }

        return implode('-',$export);

    }

    public static function decode($num) {

        $parts = explode('-',$num);
        $num = $parts[0];

        $num = strrev($num);

        $base = strlen(self::$key);
        $index = substr(self::$key, 0, $base);

        $out = 0;
        $len = strlen($num) - 1;
        for ($t = 0; $t <= $len; $t++) {
            $out = $out + strpos($index, substr($num, $t, 1)) * pow($base, $len - $t);
        }
        return $out-1000;
    }

    public static function generateBase() {
        $D = explode(',','A,B,C,D,E,F,G,H,L,M,N,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9');
        shuffle($D);
        $str = implode("", $D);
        return $str;
    }

}