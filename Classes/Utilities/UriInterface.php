<?php

namespace SaschaEnde\T3helpers\Utilities;

interface UriInterface {

    public function getByPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true);
    public function getByAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true);

}