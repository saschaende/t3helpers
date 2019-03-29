<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class FrontendUser implements SingletonInterface  {

    /**
     * @return User
     */
    public function getCurrentUser() {
        return $GLOBALS['TSFE']->fe_user;
    }

    /**
     * Manually login a user
     * @param $username
     * @throws \ReflectionException
     */
    public function loginUser($username)
    {
        $GLOBALS['TSFE']->fe_user->checkPid = '';
        $info = $GLOBALS['TSFE']->fe_user->getAuthInfoArray();
        $user = $GLOBALS['TSFE']->fe_user->fetchUserRecord($info['db_user'], $username);
        $loginData = array('uname' => $username, 'uident' => $user['password'], 'status' => 'login');

        $GLOBALS['TSFE']->fe_user->forceSetCookie = TRUE;
        $GLOBALS['TSFE']->fe_user->createUserSession($user);

        $reflection = new \ReflectionClass($GLOBALS['TSFE']->fe_user);
        $setSessionCookieMethod = $reflection->getMethod('setSessionCookie');
        $setSessionCookieMethod->setAccessible(TRUE);
        $setSessionCookieMethod->invoke($GLOBALS['TSFE']->fe_user);

        $GLOBALS['TSFE']->fe_user->user = $GLOBALS['TSFE']->fe_user->fetchUserSession();
        $session_data = $GLOBALS['TSFE']->fe_user->fetchUserSession();
        $loginSuccess = $GLOBALS['TSFE']->fe_user->compareUident($user, $loginData);

        setcookie('fe_typo_user', $session_data['ses_id'], time() + (86400 * 30), "/");
        setcookie('nc_staticfilecache', 'fe_typo_user_logged_in', time() + (86400 * 30), "/");
    }

}