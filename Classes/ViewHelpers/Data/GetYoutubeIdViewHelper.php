<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Data;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class GetYoutubeIdViewHelper extends AbstractTagBasedViewHelper {

    private function get_youtube_id_from_url($url) {
        preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $results);
        return $results[6];
    }


    /**
     * @param $youtube_url
     * @return mixed
     */
    public function render($youtube_url) {
        return $this->get_youtube_id_from_url($youtube_url);
    }
}
