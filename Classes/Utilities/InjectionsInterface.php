<?php

namespace SaschaEnde\T3helpers\Utilities;

interface InjectionsInterface {

    /**
     * @param $ext
     * @return $this
     */
    public function setExtension($ext);
    public function phpFile($filepath);
    public function jsFile($filepath);
    public function jsLibraryFile($filepath);
    public function cssFile($filepath);
    public function cssLibraryFile($filepath);

}