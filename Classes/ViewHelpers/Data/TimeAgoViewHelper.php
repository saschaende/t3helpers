<?php

namespace SaschaEnde\T3helpers\ViewHelpers\Data;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * {namespace t3h=SaschaEnde\T3helpers\ViewHelpers}
 */
class TimeAgoViewHelper extends AbstractTagBasedViewHelper {

    /**
     * @param \DateTime $date
     * @return mixed
     */
    public function render(\DateTime $date) {
        return $this->time_ago($date->getTimestamp());
    }

    private function time_ago($timestamp){

        //date_default_timezone_set("Asia/Kolkata");
        $seconds = time()-$timestamp;

        $minutes = round($seconds / 60); // value 60 is seconds
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
        $weeks   = round($seconds / 604800); // 7*24*60*60;
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60){

            return "Just Now";

        } else if ($minutes <= 60){

            if ($minutes == 1){

                return "one minute ago";

            } else {

                return "$minutes minutes ago";

            }

        } else if ($hours <= 24){

            if ($hours == 1){

                return "an hour ago";

            } else {

                return "$hours hrs ago";

            }

        } else if ($days <= 7){

            if ($days == 1){

                return "yesterday";

            } else {

                return "$days days ago";

            }

        } else {
            return strftime('%d. %B %Y', $timestamp);
        }
    }
}