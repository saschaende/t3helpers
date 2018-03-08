<?php

namespace SaschaEnde\T3helpers\Utilities;

interface PasswordInterface {

    public function getHashedPassword($password);
    public function createReadablePassword($letters = 8, $length = false);

}