<?php

namespace SaschaEnde\T3helpers\Utilities;

interface SettingsInterface {

    /**
     * @param $extensionName
     * @param string $part
     * @return mixed
     */
    public function getExtension($extensionName, $part = 'settings');

    public function getPlugin($extensionName, $pluginName);
    public function getFullTyposcript();

}