<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

class Template implements TemplateInterface, SingletonInterface {

    public function render($extension, $path, $variables = []) {
        $templatePathAndFilename = t3h::Filesystem()->getFileExtPath($extension,$path);
        /** @var StandaloneView $emailView */
        $emailView = t3h::injectClass(StandaloneView::class);
        $emailView->setFormat('html');
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        return $emailView->render();
    }

}