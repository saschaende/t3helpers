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

    /**
     * @param bool $part default: false (BE, DB, EXT, MAIL, FE, SYS...)
     * @return mixed
     */
    public function getTypo3Configuration($part = false);

}