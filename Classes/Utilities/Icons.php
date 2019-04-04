<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Icons implements SingletonInterface {

    protected $extension;

    /**
     * @param string $ext Extension name
     * @return $this
     */
    public function setExtension($ext) {
        $this->extension = $ext;
        return $this;
    }

    /**
     * Add icon file
     * @param string $icon F.e. Extension.png
     * @param string $identifier
     */
    public function add($icon,$identifier){
        $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);

        $iconRegistry->registerIcon(
            'users',
            \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
            ['source' => 'EXT:'.$this->extension.'/Resources/Public/Icons/'.$icon]
        );
    }

}