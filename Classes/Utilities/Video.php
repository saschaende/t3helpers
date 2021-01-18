<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;

class Video implements SingletonInterface
{
    public function thumbnail($source, $destination, $maxWidth = 200, $maxHeight = 200)
    {
        // Settings
        $second             = 1;

        // FFmpeg Command to generate video thumbnail
        $cmd = sprintf(
            'ffmpeg -i %s -ss %s -f image2 -vframes 1 %s',
            $source, $second, $destination
        );
        exec($cmd, $output, $retval);

        if ($retval)
        {
            return false;
        }
        else
        {
            t3h::Image()->thumbnail($destination,$destination,$maxWidth,$maxHeight);
            return file_exists($destination);
        }
    }

}