<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Data;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class InArrayViewHelper extends AbstractTagBasedViewHelper {

    /**
     * @param mixed $haystack
     * @param mixed $needle
     * @param string $then
     * @param string $else
     * @return string
     */
    public function render($haystack,$needle,$then = '',$else = '') {

        if (!is_array($haystack)) {
            return $else;
        }

        if (in_array($needle,$haystack)) {
            return $then;
        } else {
            return $else;
        }
    }
}
