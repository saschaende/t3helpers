<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Google implements SingletonInterface {

    /**
     * @param $googleApiKey
     * @param $address
     * @return array|bool
     */
    public function getGeoCoordinates($googleApiKey, $address) {
        $res = t3h::Request()->setUrl('https://maps.googleapis.com/maps/api/geocode/json?key=' . $googleApiKey . '&address=' . urlencode($address))
            ->setType('GET')
            ->setJson(true)
            ->request()
            ->getResult();
        if($res){
            return $res;
        }else{
            return false;
        }

    }

    /**
     * Get Youtube video ID from URL
     *
     * @param string $url
     * @return mixed Youtube video ID or FALSE if not found
     */
    public function getYoutubeVideoIdByUrl($url) {
        $parts = parse_url($url);
        if (isset($parts['query'])) {
            parse_str($parts['query'], $qs);
            if (isset($qs['v'])) {
                return $qs['v'];
            } else if (isset($qs['vi'])) {
                return $qs['vi'];
            }
        }
        if (isset($parts['path'])) {
            $path = explode('/', trim($parts['path'], '/'));
            return $path[count($path) - 1];
        }
        return false;
    }

    /**
     * @param $url
     * @return mixed
     */
    private function file_get_contents_curl($url) {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;

    }
}

?>
