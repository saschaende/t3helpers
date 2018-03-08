<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
        $filePath = ExtensionManagementUtility::extPath($extension) . $path;
        require_once($filePath);
    }

}
