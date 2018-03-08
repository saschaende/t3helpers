<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Google implements SingletonInterface {

    public function getGeoCoordinates($googleApiKey, $address) {
        $res = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $googleApiKey . '&address=' . $address);
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
}

?>
