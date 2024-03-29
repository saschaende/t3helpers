<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;
use TYPO3\CMS\Saltedpasswords\Utility\SaltedPasswordsUtility;

/**
 * TYPO3 9:
 * $hashInstance = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory::class)->getDefaultHashInstance('FE');
 * $user->setPassword($hashInstance->getHashedPassword($user->getPassword()));
 * @todo TYPO3 9
 */
class Password implements SingletonInterface {

    /**
     * Get the hashed password
     * @return null|string
     */
    public function getHashedPassword($password) {
        if (SaltedPasswordsUtility::isUsageEnabled('FE')) {
            $objSalt = SaltFactory::getSaltingInstance(NULL);
            if (is_object($objSalt)) {
                return $objSalt->getHashedPassword($password);
            }
        }
        return $password;
    }

    /**
     * Check password
     * @return null|string
     */
    public function checkPassword($plainPW,$saltedHashPW) {

        if(empty($plainPW) || empty($saltedHashPW)){
            return false;
        }

        $result = false;

        if (SaltedPasswordsUtility::isUsageEnabled('FE')) {
            $objSalt = SaltFactory::getSaltingInstance($saltedHashPW);
            if(!$objSalt){
                return false;
            }
            $result = $objSalt->checkPassword($plainPW, $saltedHashPW);
        }

        /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
        $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
        $signalSlotDispatcher->dispatch(__CLASS__, 'checkPassword', [$plainPW, $saltedHashPW, &$result]);

        return $result;
    }

    /**
     * Create a human readable password
     * @param int $letters
     * @param bool $length
     * @return string
     */
    public function createReadablePassword($letters = 8, $length = false) {
        $A = explode(',', 'a,e,i,o,u');
        if ($length) {
            $B = explode(',', 'b,d,f,g,h,k,l,m,n,p,r,s,t,w,z');
        } else {
            $B = explode(',', 'b,d,f,g,h,k,l,m,n,p,r,s,t,w,z,sch');
        }
        $val = '';
        for ($i = 1; $i <= $letters; $i++) {
            if ($i % 2 == 0) {
                $val .= $A [mt_rand(0, count($A) - 1)];
            } else {
                $val .= $B [mt_rand(0, count($B) - 1)];
            }
        }
        return $val;
    }

}