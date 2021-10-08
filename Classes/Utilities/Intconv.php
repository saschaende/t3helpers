<?php

namespace SaschaEnde\T3helpers\Utilities;

/**
 * Encode and decode integers bases on a key
 * @package SaschaEnde\T3helpers\Utilities
 */
class Intconv {

    private $key = '3PFQHN964Y1BRTAX7WSCUZG8M2ED5LV';

    public function setBase($base){
        $this->key = $base;
    }

    public function encode($num, $diff = 100000000) {

        $num = $num+$diff;

        $base = strlen($this->key);
        $index = substr($this->key, 0, $base);

        $out = "";
        for ($t = floor(log10($num) / log10($base)); $t >= 0; $t--) {
            $a = floor($num / pow($base, $t));
            $out = $out.substr($index, $a, 1);
            $num = $num - ($a * pow($base, $t));
        }

        $result = strrev($out);

        return $result;

    }

    public function decode($num, $diff = 100000000) {

        $num = strrev($num);

        $base = strlen($this->key);
        $index = substr($this->key, 0, $base);

        $out = 0;
        $len = strlen($num) - 1;
        for ($t = 0; $t <= $len; $t++) {
            $out = $out + strpos($index, substr($num, $t, 1)) * pow($base, $len - $t);
        }
        return $out-$diff;
    }

    public function generateBase() {
        $D = explode(',','A,B,C,D,E,F,G,H,L,M,N,P,Q,R,S,T,U,V,W,X,Y,Z,1,2,3,4,5,6,7,8,9');
        shuffle($D);
        $str = implode("", $D);
        return $str;
    }

}