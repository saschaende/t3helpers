<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Css;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class ClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param string $css
     * @return string
     */
    public function render($css = null)
    {
        $css = explode(',',$css);
        return implode(" ",$css);
    }
}
