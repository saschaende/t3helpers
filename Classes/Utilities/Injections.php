<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;

class Injections implements SingletonInterface {

    public function phpFile($extension, $path) {
        $filePath = t3h::Filesystem()->getFileExtPath($extension, $path);
        require_once($filePath);
    }

}