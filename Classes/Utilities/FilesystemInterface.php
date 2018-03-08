<?php

namespace SaschaEnde\T3helpers\Utilities;

interface FilesystemInterface {

    public function getFileByID($id);
    public function getFilesByFolder($folder);
    public function getFileExtPath($extension, $path);

}