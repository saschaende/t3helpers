<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class Uri
 * @link http://wissen.netzhaut.de/typo3/extensionentwicklung/typolink-realurl-in-scheduler-tasks/
 * @package SaschaEnde\T3helpers\Utilities
 */
class Uri implements SingletonInterface {

    public function getByPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true) {
        return $GLOBALS['TSFE']->cObj->typoLink_URL([
            'parameter' => $pid,
            'useCacheHash' => $useCacheHash,
            'returnLast' => 'url',
            'forceAbsoluteUrl' => $forceAbsoluteUrl
        ]);
    }

    public function getByAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true) {

        $extraParameters['controller'] = $controller;
        $extraParameters['action'] = $action;

        $params = [
            $extension => $extraParameters
        ];

        if ($typeNum) {
            $params['type'] = $typeNum;
        }

        return $GLOBALS['TSFE']->cObj->typoLink_URL([
            'parameter' => $pid,
            'additionalParams' => '&' . http_build_query($params),
            'useCacheHash' => $useCacheHash,
            'returnLast' => 'url',
            'forceAbsoluteUrl' => $forceAbsoluteUrl
        ]);
    }


}