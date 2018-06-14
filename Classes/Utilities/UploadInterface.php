<?php

namespace SaschaEnde\T3helpers\Utilities;

interface UploadInterface {

    /**
     * @param $filetypes
     * @return $this
     */
    public function setAllowedFiletypes($filetypes);

    /**
     * @param $size
     * @return $this
     */
    public function setMaxFilesize($size);

    /**
     * @param $size
     * @return $this
     */
    public function setMaxFilesizeTotal($size);

    /**
     * @param $setting
     * @return $this
     */
    public function setAutofilenames($setting);

    public function check();

    public function execute($target_folder);

}