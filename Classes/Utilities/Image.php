<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Image implements SingletonInterface
{

    public function thumbnail($source, $destination, $maxWidth = 200, $maxHeight = 200)
    {
        // Get new dimensions
        list($width_orig, $height_orig) = getimagesize($source);

        $ratio_orig = $width_orig / $height_orig;

        if ($maxWidth / $maxHeight > $ratio_orig) {
            $width = $maxHeight * $ratio_orig;
            $height = $maxHeight;
        } else {
            $width = $maxWidth;
            $height = $maxWidth / $ratio_orig;
        }

        // Resample
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromstring(file_get_contents($source));
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        // Output
        imagejpeg($image_p, $destination, 90);

        return file_exists($destination);
    }

}