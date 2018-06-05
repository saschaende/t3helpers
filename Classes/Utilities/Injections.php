<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Injections implements InjectionsInterface, SingletonInterface {

    protected $extension;

    /**
     * @param $ext
     * @return $this
     */
    public function setExtension($ext){
        $this->extension = $ext;
        return $this;
    }

    /**
     * @param $filepath
     */
    public function phpFile($filepath) {
        $path = t3h::Filesystem()->getFileExtPath($this->extension, $filepath);
        require_once($path);
    }

    /**
     * @param $filepath
     */
    public function jsFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFile($path);
    }

    /**
     * @param $filepath
     */
    public function jsLibraryFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsLibrary($path);
    }

    /**
     * @param $filepath
     */
    public function cssFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile($path);
    }

    /**
     * @param $filepath
     */
    public function cssLibraryFile($filepath){
        // Get path
        $path = t3h::Filesystem()->getFileExtPath($this->extension,$filepath);
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssLibrary($path);
    }

}