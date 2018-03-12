<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Injections implements SingletonInterface {

    public function phpFile($extension, $path) {
        $filePath = t3h::Filesystem()->getFileExtPath($extension, $path);
        require_once($filePath);
    }

    /**
     * @todo Aufräumen und fertich machen
     */
    public function jsFile($ext, $jspath = 'Language'){

        // return default
        $path = '../typo3conf/ext/'.$ext.'/Resources/Public/JavaScript/'.$jspath.'/en.js';

        // check if there is a translation
        $abs_path = ExtensionManagementUtility::extPath($ext) . 'Resources/Public/JavaScript/'.$jspath;
        if(file_exists($abs_path.'/'.$this->getLanguage().'.js')){
            $path = '../typo3conf/ext/'.$ext.'/Resources/Public/JavaScript/'.$jspath.'/'.$this->getLanguage().'.js';
        }

        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->addJsFile($path);

    }

}