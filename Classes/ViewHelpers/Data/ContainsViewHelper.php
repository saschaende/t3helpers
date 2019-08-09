<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Data;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Check, if an object storage contains an object
 */
class ContainsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @return void
     */
    public function initializeArguments() {
        $this->registerArgument('objectstorage', 'object', 'Object Storage');
        $this->registerArgument('object', 'object', 'Object');
    }

    public function render() {
        /** @var ObjectStorage $objectstorage */
        $objectstorage = $this->arguments['objectstorage'];
        return $objectstorage->contains($this->arguments['object']);
    }
}
