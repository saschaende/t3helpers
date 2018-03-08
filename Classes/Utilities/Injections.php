<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Injections implements SingletonInterface {

    public function phpFile($extension, $path) {
        $filePath = t3h_getFileExtPath($extension, $path);
        require_once($filePath);
    }

}