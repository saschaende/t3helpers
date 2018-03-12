<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class BackendUser
 * Backend Userdata is only available in Backend and on pages where the backend user has permissions. Otherwise this will return null
 * @package SaschaEnde\T3helpers\Utilities
 */
class BackendUser implements SingletonInterface {

    protected $beUser;

    /**
     * Get the user (that is logged in)
     * @return mixed|\TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    public function __construct(){
        $this->beUser = $GLOBALS['BE_USER'];
    }

    public function get(){
        return $this->beUser;
    }

    public function getGroups(){
        return $this->beUser->userGroups;
    }

}