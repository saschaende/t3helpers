<?php

namespace SaschaEnde\T3helpers\ViewHelpers;

/***************************************************************
 * Copyright notice
 *
 * (c) 2016 Marc Horst <info@marc-horst.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 * Example
 * {namespace m=TYPO3\Fluidseo\ViewHelpers}
 *
 * @package TYPO3
 * @subpackage Fluidseo
 * @version
 */
class FluidseoViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * Simple Fluid SEO Viewhelper
     * @param string $tag
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