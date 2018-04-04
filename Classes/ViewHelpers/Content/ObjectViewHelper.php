<?php
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Sascha Ende <s.ende@pixelcreation.de>, pixelcreation GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace SaschaEnde\T3helpers\ViewHelpers\Content;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;


class ObjectViewHelper extends AbstractViewHelper {

    /**
     * @var \SaschaEnde\T3helpers\Domain\Repository\ContentsRepository
     * @inject
     */
    protected $contentsRepository;

    /**
     * Arguments initialization.
     *
     * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
     * @throws \TYPO3\CMS\Fluid\Core\ViewHelper\Exception
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'uid',
            'integer',
            'UID of the content element'
        );
        $this->registerArgument(
            'as',
            'string',
            'Template variable name to assign; if not specified the ViewHelper returns the variable instead.'
        );
    }

    /**
     * @param integer $uid
     * @return string
     */
    public function render() {

        if ($this->templateVariableContainer->exists($this->arguments['as']) === TRUE) {
            $this->templateVariableContainer->remove($this->arguments['as']);
        }
        $cobject = $this->contentsRepository->findByIdentifier($this->arguments['uid']);
        $this->templateVariableContainer->add($this->arguments['as'], $cobject);
        $content = $this->renderChildren();

        return $content;
    }
}
