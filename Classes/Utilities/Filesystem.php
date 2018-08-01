<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Filesystem implements FilesystemInterface, SingletonInterface {

    /**
     * Check if file exists in a folder
     * @param $folder
     * @param $fileName
     * @return bool
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function fileExists($folder,$fileName){
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $defaultStorage->getFolder($folder);
        return $defaultStorage->hasFileInFolder($fileName,$folderObj);
    }

    /**
     * @param $folder
     * @param $fileName
     * @return null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFileByName($folder,$fileName){
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $defaultStorage->getFolder($folder);
        return $defaultStorage->getFileInFolder($fileName,$folderObj);
    }

    /**
     * @param $folder
     * @param $fileName
     * @return bool|null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function deleteFileByName($folder,$fileName){
        $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $defaultStorage->getFolder($folder);
        return $defaultStorage->getFileInFolder($fileName,$folderObj)->delete();
    }

    /**
     * @param $id
     * @return array|bool
     */
    public function getFileByID($id) {

        $resourceFactory = ResourceFactory::getInstance();

        try {
            $fo = $resourceFactory->getFileObject($id);
        } catch (Exception $e) {
            return false;
        }

        if ($fo) {
            $props = $fo->getProperties();
        } else {
            return false;
        }

        return $props;
    }

    /**
     * @param $id
     * @return bool|\TYPO3\CMS\Core\Resource\File
     */
    public function getFileObjectByID($id) {

        $resourceFactory = ResourceFactory::getInstance();

        try {
            $fo = $resourceFactory->getFileObject($id);
        } catch (Exception $e) {
            return false;
        }

        if ($fo) {
            return $fo;
        } else {
            return false;
        }
    }

    /**
     * @param $folder
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFilesByFolder($folder) {

        $filesResult = [];

        $resourceFactory = ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $resourceFactory->getFolderObjectFromCombinedIdentifier($folder);
        $files = $defaultStorage->getFilesInFolder($folderObj);

        foreach ($files as $file) {
            $filesResult[] = $file->getProperties();
        }

        return $filesResult;

    }

    /**
     * @param $folder
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public function getFileObjectsByFolder($folder) {

        $filesResult = [];

        $resourceFactory = ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $resourceFactory->getFolderObjectFromCombinedIdentifier($folder);
        $files = $defaultStorage->getFilesInFolder($folderObj);

        foreach ($files as $file) {
            $filesResult[] = $file;
        }

        return $filesResult;

    }

    /**
     * @param $extension
     * @param $path
     * @return string
     */
    public function getFileExtPath($extension, $path) {
        return ExtensionManagementUtility::extPath($extension) . $path;
    }

    /**
     * @param $uid
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function getCategoriesForFile($uid){
        /** @var CategoryRepository $categories */
        $categories = t3h::injectClass(CategoryRepository::class);
        $query = $categories->createQuery();
        $query->statement("SELECT cat.* FROM sys_file_metadata as meta LEFT JOIN sys_category_record_mm AS mm ON mm.uid_foreign = meta.uid LEFT JOIN sys_category AS cat ON cat.uid = mm.uid_local WHERE meta.file = ".intval($uid)." AND mm.tablenames = 'sys_file_metadata'");
        return $query->execute();
    }

}
