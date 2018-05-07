<?php

namespace SaschaEnde\T3helpers\Utilities;

class FrontendUser {

    /**
     * @return User
     */
    public function getCurrentUser() {
        return $GLOBALS['TSFE']->fe_user;
    }

}