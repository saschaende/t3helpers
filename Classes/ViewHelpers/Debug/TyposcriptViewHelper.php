<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Debug;

use t3h\t3h;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class TyposcriptViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param string $css
     * @return string
     */
    public function render()
    {
        t3h::Debug()->dumpFullTyposcript();
    }
}
