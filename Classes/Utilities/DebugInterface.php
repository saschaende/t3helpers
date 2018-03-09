<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DebugInterface {

    public function dump($data);
    public function mail($fromEmail, $recipientEmail, $data);
    public function dumpFullTyposcript();

}