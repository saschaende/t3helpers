<?php

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class Template implements SingletonInterface {

    public function render($extension, $path, $variables = []) {
        $templatePathAndFilename = \T3h\Filesystem()->getFileExtPath($extension,$path);
        /** @var StandaloneView $emailView */
        $emailView = \T3h\injectClass(StandaloneView::class);
        $emailView->setFormat('html');
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        return $emailView->render();
    }

}