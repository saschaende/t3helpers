<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Typoscript;

use t3h\t3h;
use TYPO3\CMS\Core\TypoScript\TypoScriptService;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 * Get Typoscript settings from everywhere:
 * <t3h:typoscript.get path="plugins.tx_myplugin.settings.mysetting"/>
 */
class GetViewHelper extends AbstractViewHelper
{

    public function initializeArguments()
    {
        $this->registerArgument('path', 'mixed', 'TYPOSCRIPT variable path', true);
    }

    public function render()
    {
        $res = t3h::Datastorage()->extension('SaschaEnde\T3helpers\ViewHelpers\Typoscript\Get')->get($this->arguments['path']);
        if(!$res){
            $configurationManager = t3h::injectClass(ConfigurationManager::class);
            $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
            /** @var TypoScriptService $typoScriptService */
            $typoScriptService = t3h::injectClass(TypoScriptService::class);
            $extbaseFrameworkConfiguration = $typoScriptService->convertTypoScriptArrayToPlainArray($extbaseFrameworkConfiguration);
            $res = t3h::Arr()->get($extbaseFrameworkConfiguration, $this->arguments['path']);
            t3h::Datastorage()->extension('SaschaEnde\T3helpers\ViewHelpers\Typoscript\Get')->set($this->arguments['path'],$res);
        }
        return $res;
    }
}