<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Resource\File;

interface FilesystemInterface {

    /**
     * Check if file exists in a folder
     * @param $folder
     * @param $fileName
     * @return bool
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function fileExists($folder,$fileName);

    /**
     * @param $folder
     * @param $fileName
     * @return null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFileByName($folder,$fileName);

    /**
     * @param $folder
     * @param $fileName
     * @return bool|null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function deleteFileByName($folder,$fileName);

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
     * @param $folder
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFileObjectsByFolder($folder);


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

    /**
     * Always Use this AFTER adding a new object to the database - because you need the $uid_foreign of this object :)
     * @param \TYPO3\CMS\Core\Resource\File $file File Object (FAL), the uploaded file
     * @param $uid_foreign UID of the element (for example a content element)
     * @param $pid Page UID of the page, where the item is stored
     * @param $table tha table of the item (for example tt_content)
     * @param $fieldname the field name for the relations (for example "assets")
     * @return bool true|false
     */
    public function setFileReference(File $file, $uid_foreign, $pid, $table, $fieldname);


    /**
     * Get a unique filename
     * @param $originFilename
     * @return mixed
     */
    public function getUniqueFilename($originFilename);

}