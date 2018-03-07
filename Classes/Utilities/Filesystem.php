<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Resource\ResourceFactory;

/**
 * Class Filemanager
 * Hilt wunderschön dabei, anhand von FileUIDs oder Verzeichnissen an die Daten der entsprechenden Dateien zu kommen
 * @package Pixelcreation\PxcAudiogallery\Utility
 */
class Filesystem {

    /**
     * Erhalte alle Properties einer Datei als Array
     * @param $id
     * @return array|bool
     * @throws \TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException
     */
    public static function getFileByID($id) {

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
     * Erhalte anhand eines Pfades die darin enthaltenen Dateien als Array
     * @param $folder
     * @return array
     * @throws \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException
     */
    public static function getFilesByFolder($folder){

        $filesResult = [];

        $resourceFactory = ResourceFactory::getInstance();
        $defaultStorage = $resourceFactory->getDefaultStorage();
        $folderObj = $resourceFactory->getFolderObjectFromCombinedIdentifier($folder);
        $files = $defaultStorage->getFilesInFolder($folderObj);

        foreach($files as $file){
            $filesResult[] = $file->getProperties();
        }

        return $filesResult;

    }

}
