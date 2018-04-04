<?php

namespace SaschaEnde\T3helpers\Utilities;

interface FilesystemInterface {

    /**
     * @param $id
     * @return array|bool
     */
    public function getFileByID($id);

    /**
     * @param $id
     * @return bool|\TYPO3\CMS\Core\Resource\File
     */
    public function getFileObjectByID($id);

    /**
     * @param $folder
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFilesByFolder($folder);


    /**
     * @param $extension
     * @param $path
     * @return string
     */
    public function getFileExtPath($extension, $path);

    /**
     * @param $uid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getCategoriesForFile($uid);

}