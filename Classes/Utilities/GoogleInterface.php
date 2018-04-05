<?php

namespace SaschaEnde\T3helpers\Utilities;

interface GoogleInterface {

    /**
     * @param $googleApiKey
     * @param $address
     * @return array|bool
     */
    public function getGeoCoordinates($googleApiKey, $address);

    /**
     * Get Youtube video ID from URL
     *
     * @param string $url
     * @return mixed Youtube video ID or FALSE if not found
     */
    public function getYoutubeVideoIdByUrl($url);

}