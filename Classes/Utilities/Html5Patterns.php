<?php

namespace SaschaEnde\T3helpers\Utilities;
use TYPO3\CMS\Core\SingletonInterface;

class Html5Patterns implements Html5PatternsInterface, SingletonInterface {

    /**
     * Send suggestions for usable patterns via github
     * @var array
     */
    protected  $patterns = [
        'date' => '[0-9]{2}.[0-9]{2}.[0-9]{4}', // Format: DD.MM.YYYY
        'time'  =>  '(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}', // Format: HH:MM:SS
        'datetime'  =>  '/([0-2][0-9]{3})\-([0-1][0-9])\-([0-3][0-9])T([0-5][0-9])\:([0-5][0-9])\:([0-5][0-9])(Z|([\-\+]([0-1][0-9])\:00))/', // Date according to W3C for input type="datetime". Matches the following: 1990-12-31T23:59:60Z or 1996-12-19T16:39:57-08:00
        'email' => '[a-zA-Z0-9.-_]{1,}@[a-zA-Z0-9.-]{1,}[.]{1}[a-zA-Z0-9]{2,}',
        'zipgerman' =>  '[0-9]{5}', // German postal code
        'hexcolor'  =>  '^#?([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$',
        'password1' => '^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$', // Password (UpperCase, LowerCase and Number)
        'password2'  => '(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$', // Password (UpperCase, LowerCase, Number/SpecialChar and min 8 Chars),
        'ipv4'  =>  '((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$', // IPv4 Address
        'ipv6'  =>  '((^|:)([0-9a-fA-F]{0,4})){1,8}$', // IPv6 Address
        'isbn'  => '(?:(?=.{17}$)97[89][ -](?:[0-9]+[ -]){2}[0-9]+[ -][0-9]|97[89][0-9]{10}|(?=.{13}$)(?:[0-9]+[ -]){2}[0-9]+[ -][0-9Xx]|[0-9]{9}[0-9Xx])', // ISBN
        'price1'    =>  '\d+(\.\d{2})?', // Price (Format: 1.00)
        'price2'    =>  '\d+(,\d{2})?', // Price (Format: 1,00)
        'geo'   =>  '-?\d{1,3}\.\d+', // Latitude or Longitude

    ];

    public function get(){
        return $this->patterns;
    }

}