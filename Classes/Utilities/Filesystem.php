<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;

class Filesystem implements SingletonInterface {

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

    public function getFileExtPath($extension, $path) {
        return ExtensionManagementUtility::extPath($extension) . $path;
    }

    public function getCategoriesForFile($uid){
        /** @var CategoryRepository $categories */
        $categories = t3h::injectClass(CategoryRepository::class);
        $query = $categories->createQuery();
        $query->statement("SELECT cat.* FROM sys_file_metadata as meta LEFT JOIN sys_category_record_mm AS mm ON mm.uid_foreign = meta.uid LEFT JOIN sys_category AS cat ON cat.uid = mm.uid_local WHERE meta.file = ".intval($uid)." AND mm.tablenames = 'sys_file_metadata'");
        return $query->execute();
    }

}
