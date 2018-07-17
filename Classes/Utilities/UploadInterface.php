<?php

namespace SaschaEnde\T3helpers\Utilities;

interface UploadInterface {

    /**
     * Set allowed filetypes
     * @param $filetypes
     * @return $this
     */
    public function setAllowedFiletypes($filetypes);

    /**
     * Set max filesize, allowed for each file
     * @param $size
     * @return $this
     */
    public function setMaxFilesize($size);

    /**
     * Enable autonaming of uploaded files with hash values
     * @param $setting
     * @return $this
     */
    public function setAutofilenames($setting);

    /**
     * Check uploaded files and set them for upload
     * @return array
     */
    public function check();

    /**
     * Get the list of files that will be uploaded
     * @return array
     */
    public function getFiles();

    /**
     * Upload files to target directory. If no target is given, temp folder will be used
     * @param $target_folder
     */
    public function execute($target_folder = false);

}