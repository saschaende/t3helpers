<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DebugInterface {

    public function output($data);
    public function mailoutput($fromEmail, $recipientEmail, $data);
    public function debugFullTyposcript();

}