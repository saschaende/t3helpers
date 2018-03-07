<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Debug {

    public static function output($data) {
        DebuggerUtility::var_dump($data);
    }

    public static function mailoutput($fromEmail, $recipientEmail, $data) {
        Mail::sendMail(
            $recipientEmail,
            $fromEmail,
            'Debugger',
            'Debug Output',
            print_r($data, true)
        );
    }

}