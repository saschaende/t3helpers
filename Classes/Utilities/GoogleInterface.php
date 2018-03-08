<?php

namespace SaschaEnde\T3helpers\Utilities;

interface GoogleInterface {

    public function getGeoCoordinates($googleApiKey, $address);

}