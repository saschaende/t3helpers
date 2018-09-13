<?php

namespace SaschaEnde\T3helpers\Utilities;

interface FrontendUserInterface {

    public function getCurrentUser();

    /**
     * Manually login a user
     * @param $username
     * @throws \ReflectionException
     */
    public function loginUser($username);

}