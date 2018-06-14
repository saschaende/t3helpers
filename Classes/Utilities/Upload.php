<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\SingletonInterface;

class Upload implements UploadInterface, SingletonInterface {

    protected $maxFiles = null;
    protected $allowedFiletypes = ['jpg','jpeg','zip','rar','pdf','gif'];
    protected $maxFilesize = null;
    protected $maxFilesizeTotal = null;
    protected $targetFolder = '';
    protected $autoFilenames = true;
    protected $FILES = [];

    /**
     * @param $filetypes
     * @return $this
     */
    public function setAllowedFiletypes($filetypes){
        $this->allowedFiletypes = $filetypes;
        return $this;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setMaxFilesize($size){
        $this->maxFilesize = $size;
        return $this;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setMaxFilesizeTotal($size){
        $this->maxFilesizeTotal = $size;
        return $this;
    }

    /**
     * @param $setting
     * @return $this
     */
    public function setAutofilenames($setting){
        $this->autoFilenames = $setting;
        return $this;
    }

    public function check(){
        foreach($_FILES as $ext=>$FILES){
            foreach($FILES['name'] as $prop=>$value){
                $this->FILES[$prop] = [
                    'name'  =>  $FILES['name'][$prop],
                    'type'  =>  $FILES['type'][$prop],
                    'tmp_name'  =>  $FILES['tmp_name'][$prop],
                    'error'  =>  $FILES['error'][$prop],
                    'size'  =>  $FILES['size'][$prop],
                    'pathinfo'  =>  pathinfo($FILES['name'][$prop]),
                ];
            }
        }
        debug($this->FILES);
    }

    public function execute($target_folder){
        foreach($this->FILES as $file){
            $this->move(
                $file['tmp_name'],
                $target_folder,
                $file['name']
            );
        }
    }

    private function move($tmp_file,$target_folder,$target_filename){
        $resourceFactory = ResourceFactory::getInstance();
        $storage = $resourceFactory->getDefaultStorage();
        $newFile = $storage->addFile(
            $tmp_file,
            $storage->getFolder($target_folder),
            $target_filename
        );
        return $newFile;
    }

}