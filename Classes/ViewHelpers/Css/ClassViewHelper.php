<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Css;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class ClassViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * @param mixed $css
     * @return string
     */
    public function render($css = null)
    {
        if(is_array($css)){
            $parts = [];
            foreach($css as $cssArrElement){
               $parts = array_merge($parts,explode(',',$cssArrElement));
            }
        }else{
            $parts = explode(',',$css);
        }
        return implode(" ",$parts);
    }
}
