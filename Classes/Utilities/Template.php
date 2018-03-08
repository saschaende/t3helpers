<?php

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class Template implements SingletonInterface {

    public function renderTemplate($extension, $path, $variables = []) {
        $templatePathAndFilename = t3h_getFileExtPath($extension,$path);
        /** @var StandaloneView $emailView */
        $emailView = t3h_injectClass(StandaloneView::class);
        $emailView->setFormat('html');
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        return $emailView->render();
    }

}