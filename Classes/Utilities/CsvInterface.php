<?php

namespace SaschaEnde\T3helpers\Utilities;

interface CsvInterface {

    /**
     * @param $file
     * @return $this
     */
    public function setFile($file);

    /**
     * @param bool $autoUTF
     * @return $this
     */
    public function setAutoUTF($autoUTF);

    /**
     * Get parsed file
     * @param bool $object Set true, to return std objects
     * @return array|bool|null
     */
    public function getFileParsed($object = false);

    /**
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @return $this
     */
    public function setFormatting($delimiter = ',', $enclosure = '"', $escape = "\\");

    /**
     * @param $column
     * @param string $regex
     * @param string $option
     * @param bool $emptyAllowed
     * @param null $pos
     * @return $this|CsvInterface
     */
    public function addRule($column, $regex = 'any', $option = '', $emptyAllowed = false, $pos = null);

    /**
     * Check the csv against the rules
     * @return array
     */
    public function check();

}