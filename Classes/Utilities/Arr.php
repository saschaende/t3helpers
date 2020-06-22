<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Arr implements SingletonInterface {

    /**
     * @param array $a
     * @param $path
     * @param null $default
     * @return array|mixed|null
     */
    public function get(array $a, $path, $default = null)
    {
        $current = $a;
        $p = strtok($path, '.');

        while ($p !== false) {
            if (!isset($current[$p])) {
                return $default;
            }
            $current = $current[$p];
            $p = strtok('.');
        }

        return $current;
    }

}