<?php

namespace SaschaEnde\T3helpers\Utilities;

interface  BackendUserInterface {

    public function __construct();

    /**
     * @return mixed|\TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    public function get();

    /**
     * @return array
     */
    public function getGroups();

    /**
     * @return array
     */
    public function getAllowedPages();

    /**
     * @return array
     */
    public function getAllowedPagesUris();
}