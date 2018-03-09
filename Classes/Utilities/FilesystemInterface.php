<?php

namespace SaschaEnde\T3helpers\Utilities;

interface FilesystemInterface {

    /**
     * @param $id
     * @return array
     */
    public function getFileByID($id);

    /**
     * @param $folder
     * @return array
     */
    public function getFilesByFolder($folder);


    public function getFileExtPath($extension, $path);

}