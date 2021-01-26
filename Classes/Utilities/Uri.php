<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

/**
 * Class Uri
 * @link http://wissen.netzhaut.de/typo3/extensionentwicklung/typolink-realurl-in-scheduler-tasks/
 * @package SaschaEnde\T3helpers\Utilities
 */
class Uri implements SingletonInterface {

    /**
     * Get a page link by PID
     * @param $pid Page UID
     * @param bool $useCacheHash
     * @param bool $forceAbsoluteUrl
     * @param array $additionalParameters
     * @return string
     */
    public function getByPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true, $additionalParameters = [], $root_id = 0) {

        if (TYPO3_MODE == 'BE') {
            t3h::Tsfe()->init($root_id);
        }

        return $GLOBALS['TSFE']->cObj->typoLink_URL([
            'parameter' => intval($pid),
            'useCacheHash' => $useCacheHash,
            'returnLast' => 'url',
            'forceAbsoluteUrl' => $forceAbsoluteUrl,
            'additionalParams' => '&' . http_build_query($additionalParameters),
        ]);
    }

    /**
     * Get link for a restricted page (you have to prepend the host manually)
     * @param $pid
     * @param $extension
     * @param $controller
     * @param $action
     * @param array $arguments
     * @return string
     */
    public function getByActionForRestrictedPage($pid, $extension, $controller, $action, $arguments = [])
    {

        $arguments['controller'] = $controller;
        $arguments['action'] = $action;

        $params = [
            $extension => $arguments,
        ];

        /** @var UriBuilder $uriBuilder */
        $uriBuilder = t3h::injectClass(UriBuilder::class);

        return $uriBuilder
            ->reset()
            ->setArguments($params)
            ->setLinkAccessRestrictedPages(true)
            ->setTargetPageUid($pid)
            ->build();
    }

    /**
     * @param $pid
     * @param $extension
     * @param $controller
     * @param $action
     * @param array $arguments
     * @param bool $typeNum
     * @param bool $useCacheHash
     * @param bool $forceAbsoluteUrl
     * @param array $additionalParameters
     * @return string
     */
    public function getByAction($pid, $extension, $controller, $action, $arguments = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true, $additionalParameters = [], $root_id = 0) {

        if (TYPO3_MODE == 'BE') {
            t3h::Tsfe()->init($root_id);
        }

        $arguments['controller'] = $controller;
        $arguments['action'] = $action;

        $params = [
            $extension => $arguments,
        ];

        if ($typeNum) {
            $params['type'] = $typeNum;
        }

        foreach ($additionalParameters as $key=>$value){
            $params[$key] = $value;
        }

        return $GLOBALS['TSFE']->cObj->typoLink_URL([
            'parameter' => intval($pid),
            'additionalParams' => '&' . http_build_query($params),
            'useCacheHash' => $useCacheHash,
            'returnLast' => 'url',
            'forceAbsoluteUrl' => $forceAbsoluteUrl
        ]);
    }


    function getSlug($text)
    {
        $text = str_replace('-', ' ',$text);
        $text = preg_replace('/\s+/', ' ',$text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
    }

}