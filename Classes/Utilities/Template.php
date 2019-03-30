<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class Template implements SingletonInterface {

    /**
     * Render a template, it will be called dynamically depending on template, layout and partials paths. This will not work without TYPOSCRIPT settings.
     * @param string $extension
     * @param string $template
     * @param array $variables
     * @param null $controllerContext
     * @return string|void
     */
    public function renderDynamic($extension = 'tx_myextension',$template = 'Default',$variables = [], $controllerContext = null){

        /** @var StandaloneView $emailView */
        $emailView = t3h::injectClass(StandaloneView::class);
        $emailView->setFormat('html');
        if($controllerContext != null){
            $emailView->setControllerContext($controllerContext);
        }

        // Templates
        $cfg = t3h::Settings()->getExtension($extension,'view');
        $emailView->setLayoutRootPaths($cfg['layoutRootPaths.']);
        $emailView->setPartialRootPaths($cfg['partialRootPaths.']);
        $emailView->setTemplateRootPaths($cfg['templateRootPaths.']);
        $emailView->setTemplate($template);

        $emailView->assignMultiple($variables);
        return $emailView->render();
    }

    /**
     * Render a template
     * @param $extension gridelements
     * @param $path Resources/Private/Templates/Mytemplate.html
     * @param array $variables
     * @param null $controllerContext In your controller action use $this->controllerContext, important for using translation
     * @return string
     */
    public function render($extension, $path, $variables = [], $controllerContext = null) {
        $templatePathAndFilename = t3h::Filesystem()->getFileExtPath($extension,$path);
        /** @var StandaloneView $emailView */
        $emailView = t3h::injectClass(StandaloneView::class);
        $emailView->setFormat('html');

        if($controllerContext != null){
            $emailView->setControllerContext($controllerContext);
        }

        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assignMultiple($variables);
        return $emailView->render();
    }

}