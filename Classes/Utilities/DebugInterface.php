<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DebugInterface {

    public function dump($data,$split = false);
    public function mail($fromEmail, $recipientEmail, $data);
    public function dumpFullTyposcript();

}