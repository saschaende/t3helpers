<?php

namespace SaschaEnde\T3helpers\Utilities;

/**
 * Interface ConfigurationInterface
 * @package SaschaEnde\T3helpers\Utilities
 * @ignore
 */
interface ConfigurationInterface {

    /**
     * @param $ext
     */
    public function setExtension($ext);

    /**
     * @param $propertyName
     * @return mixed
     * @throws \TYPO3\CMS\Core\Exception
     */
    public function get($propertyName);

    /**
     * @return mixed
     */
    public function getAll();

}