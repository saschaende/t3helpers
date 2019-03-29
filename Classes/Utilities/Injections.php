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
    public function setExtension($ext) {
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
    public function jsFile($filepath) {
        // Get path
        $path = 'typo3conf/ext/' . $this->extension . '/' . $filepath;
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFile(
            $path,
            'text/javascript',
            FALSE,
            FALSE,
            '',
            TRUE);
    }

    /**
     * @param $filepath
     */
    public function jsFooterFile($filepath) {
        // Get path
        $path = 'typo3conf/ext/' . $this->extension . '/' . $filepath;
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterFile(
            $path,
            'text/javascript',
            FALSE,
            FALSE,
            '',
            TRUE);
    }

    /**
     * @param $filepath
     */
    public function jsLibraryFile($filepath) {
        // Get path
        $path = 'typo3conf/ext/' . $this->extension . '/' . $filepath;

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFooterLibrary(
            md5($path),
            $path,
            'text/javascript',
            FALSE,
            FALSE,
            '',
            TRUE
        );
    }

    /**
     * @param $filepath
     */
    public function cssFile($filepath) {
        // Get path
        $path = 'typo3conf/ext/' . $this->extension . '/' . $filepath;
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssFile($path);
    }

    /**
     * @param $filepath
     */
    public function cssLibraryFile($filepath) {
        // Get path
        $path = 'typo3conf/ext/' . $this->extension . '/' . $filepath;
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addCssLibrary($path);
    }

    /**
     * Add flexform
     * @param $plugin
     */
    public function addFlexform($plugin) {
        global $TCA;
        // Stoebern: Flexform
        $extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($this->extension));
        $pluginName = strtolower($plugin);
        $pluginSignature = $extensionName . '_' . $pluginName;

        $TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,pages,recursive';
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform, layout';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $this->extension . '/Configuration/FlexForm/' . $plugin . '.xml');
    }

}