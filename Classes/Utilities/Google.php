<?php

namespace SaschaEnde\T3helpers\Utilities;

class Google {

    public static function getGeoCoordinates($googleApiKey, $address) {
        $res = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?key=' . $googleApiKey . '&address=' . $address);
        $res = json_decode($res);
        return [
            'lat' => $res->results[0]->geometry->location->lat,
            'lng' => $res->results[0]->geometry->location->lng,
        ];
    }
}

?>
