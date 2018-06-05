<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class FrontendUser implements FrontendUserInterface, SingletonInterface  {

    /**
     * @return User
     */
    public function getCurrentUser() {
        return $GLOBALS['TSFE']->fe_user;
    }

}