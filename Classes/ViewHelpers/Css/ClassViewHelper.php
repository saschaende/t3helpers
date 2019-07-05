<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Css;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class ClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('css', 'mixed', 'String to case format');
    }

    public function render() {
        $css = $this->arguments['css'];
        if (is_array($css)) {
            $parts = [];
            foreach ($css as $cssArrElement) {
                $parts = array_merge($parts, explode(',', $cssArrElement));
            }
        } else {
            $parts = explode(',', $css);
        }
        return implode(" ", $parts);
    }
}
