<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Injections implements SingletonInterface {

    protected $extension;

    /**
     * @param $ext
     * @return $this
     */
    public function setExtension($ext){
        $this->extension = $ext;
        return $this;
    }

    public function phpFile($filepath) {
        $path = t3h::Filesystem()->getFileExtPath($this->extension, $filepath);
        require_once($path);
    }

    public function jsFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFile($path);
    }

    public function jsLibraryFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsLibrary($path);
    }

    public function cssFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile($path);
    }

    public function cssLibraryFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssLibrary($path);
    }

}