<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Google implements SingletonInterface {

    public function getGeoCoordinates($googleApiKey, $address) {
        $res = $this->file_get_contents_curl('https://maps.googleapis.com/maps/api/geocode/json?key=' . $googleApiKey . '&address=' . $address);
        $res = json_decode($res);
        if(isset($res->results[0]->geometry->location->lat)){
            return [
                'lat' => $res->results[0]->geometry->location->lat,
                'lng' => $res->results[0]->geometry->location->lng,
            ];
        }else{
            return false;
        }

    }

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
