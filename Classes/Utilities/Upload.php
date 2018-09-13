<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Upload implements UploadInterface, SingletonInterface {

    protected $maxFiles = null;
    protected $allowedFiletypes = ['jpg', 'jpeg', 'zip', 'rar', 'pdf', 'gif'];
    protected $maxFilesize = null;
    protected $targetFolder = '';
    protected $autoFilenames = true;
    protected $FILES = [];

    /**
     * Set allowed filetypes
     * @param $filetypes
     * @return $this
     */
    public function setAllowedFiletypes($filetypes) {
        $this->allowedFiletypes = $filetypes;
        return $this;
    }

    /**
     * Set max filesize, allowed for each file
     * @param $size
     * @return $this
     */
    public function setMaxFilesize($size) {
        $this->maxFilesize = $size;
        return $this;
    }

    /**
     * Enable autonaming of uploaded files with hash values
     * @param $setting
     * @return $this
     */
    public function setAutofilenames($setting) {
        $this->autoFilenames = $setting;
        return $this;
    }

    /**
     * Check uploaded files and set them for upload
     * @return array
     */
    public function check() {

        /** @var BasicFileUtility $BasicFileUtility */
        $BasicFileUtility = t3h::injectClass(BasicFileUtility::class);

        $Errors = [];

        if ($this->maxFiles != null && count($_FILES['name']) > $this->maxFiles) {
            $Errors[] = [
                'error' => 'count'
            ];
        }


        foreach ($_FILES as $ext => $FILES) {
            foreach ($FILES['name'] as $prop => $value) {

                if ($FILES['size'][$prop] == 0) {
                    continue;
                }

                // get pathinfo for this file
                $pathinfo = pathinfo($FILES['name'][$prop]);

                if ($this->autoFilenames) {
                    $targetFilename = sha1($FILES['name'][$prop] . uniqid()) . time() . '.' . $pathinfo['extension'];
                } else {
                    $targetFilename = \TYPO3\CMS\Core\Resource\Driver\LocalDriver::sanitizeFileName($FILES['name'][$prop]);
                }

                $uploadfile = [
                    'targetFilename' => $targetFilename,
                    'name' => $FILES['name'][$prop],
                    'type' => $FILES['type'][$prop],
                    'tmp_name' => $FILES['tmp_name'][$prop],
                    'error' => $FILES['error'][$prop],
                    'size' => $FILES['size'][$prop],
                    'pathinfo' => $pathinfo,
                ];
                $this->FILES[] = $uploadfile;

                // Checks: Dateityp
                if (!in_array(strtolower($pathinfo['extension']), $this->allowedFiletypes)) {
                    $Errors[] = [
                        'error' => 'type',
                        'file' => $uploadfile
                    ];
                }

                // Dateigröße maximal
                if ($this->maxFilesize != null && $uploadfile['size'] > $this->maxFilesize) {
                    $Errors[] = [
                        'error' => 'size',
                        'file' => $uploadfile
                    ];
                }

            }
        }
        return $Errors;
    }

    /**
     * Get the list of files that will be uploaded
     * @return array
     */
    public function getFiles() {
        return $this->FILES;
    }

    /**
     * Upload files to target directory
     * @param $target_folder
     */
    public function execute($target_folder = false) {
        $results = [];
        foreach ($this->FILES as $file) {
            if($target_folder == false){
                $results[] = GeneralUtility::upload_to_tempfile($file['targetFilename']);
            }else{
                $results[] = GeneralUtility::upload_copy_move($file['tmp_name'], PATH_site . '/fileadmin/' . $target_folder . '/' . $file['targetFilename']);

                // Ordner neu indexieren
                $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
                $defaultStorage = $resourceFactory->getDefaultStorage();
                $folder = $defaultStorage->getFolder($target_folder);
                $files = $defaultStorage->getFilesInFolder($folder); // Aufruf dieser Zeile sorgt automatisch für eine Reindexierung des Ordners
            }

        }
        return $results;
    }

}