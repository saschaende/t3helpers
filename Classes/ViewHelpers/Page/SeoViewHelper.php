<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Page;

class SeoViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @param $tag title|og:image|og:title|og:type|og:url|og:description|fp:app_id|og:site_name
     */
    public function render($tag) {
        switch ($tag) {
            case 'title':
                $GLOBALS['TSFE']->page['title'] = trim($this->renderChildren());
                break;
            case 'og:title':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:title" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'og:type':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:type" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'og:url':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:url" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'og:image':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:image" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'og:description':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:description" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'fb:app_id':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="fb:app_id" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            case 'og:site_name':
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta property="og:site_name" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
            default:
                $GLOBALS['TSFE']->additionalHeaderData[] = '<meta name="'.$tag.'" content="'.htmlspecialchars(trim($this->renderChildren())).'"/>';
                break;
        }
    }

}
?>