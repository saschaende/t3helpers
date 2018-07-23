<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Csv implements CsvInterface, SingletonInterface {

    protected $file;
    protected $rules;

    protected $patterns = [
        'any' => ['(.*)', 'is'],
        'text' => ['^([a-zA-Z0-9ßäöüÄÖÜ\s]+)$', 'is'],
        'number' => ['^([0-9]+){5}$', 'is'],
        'plz' => ['^([0-9]+){5}$', ''],
        'email' => ['^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$', 'iD'],
        'date'  => ['^([0-9]{2}.[0-9]{2}.[0-9]{4})$','is'],
        'anrede'    =>  ['^(Herr|Frau)$', 'is']
    ];

    protected $delimiter = ',';
    protected $enclosure = '"';
    protected $escape = "\\";

    /**
     * @param $file
     * @return $this
     */
    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

    /**
     * Get parsed file
     * @param bool $object Set true, to return std objects
     * @return array|bool|null
     */
    public function getFileParsed($object = false) {
        $fileParsed = $this->parseFile();

        if($object){

            $res = [];

            foreach ($fileParsed as $row) {

                $obj = new \stdClass();

                // Für jede Spalte
                for ($i = 0; $i < count($row); $i++) {
                    $obj->{$this->rules[$i]['column']} = $row[$i];
                }

                $res[] = $obj;
            }

            return $res;

        }else{
            return $fileParsed;
        }
    }

    /**
     * @param string $delimiter
     * @param string $enclosure
     * @param string $escape
     * @return $this
     */
    public function setFormatting($delimiter = ',', $enclosure = '"', $escape = "\\") {
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->escape = $escape;
        return $this;
    }

    /**
     * @param $column
     * @param string $regex
     * @param string $option
     * @param bool $emptyAllowed
     * @return $this|CsvInterface
     */
    public function addRule($column, $regex = 'any', $option = '', $emptyAllowed = false) {

        if ($this->patterns[$regex]) {
            $regex = $this->patterns[$regex][0];
            $option = $this->patterns[$regex][1];
        }

        $this->rules[] = [
            'column' => $column,
            'regex' => $regex,
            'option' => $option,
            'emptyAllowed' => $emptyAllowed
        ];
        return $this;
    }

    /**
     * Check the csv against the rules
     * @return array
     */
    public function check() {
        $errors = [];
        $fileParsed = $this->getFileParsed();

        // Für jede Zeile
        $rowcount = 1;
        foreach ($fileParsed as $row) {
            // Für jede Spalte
            for ($i = 0; $i < count($row); $i++) {
                // Regel zur Überprüfung anwenden
                preg_match_all(
                    "/" . $this->rules[$i]['regex'] . "/" . $this->rules[$i]['option'],
                    $row[$i],
                    $output_array
                );
                if($output_array[0][0] != $row[$i] || ($this->rules[$i]['emptyAllowed'] == false && empty($row[$i]))){
                    $errors[] = [
                        'row'   =>  $rowcount,
                        'column'    => $this->rules[$i]['column'],
                        'value' =>  $row[$i]
                    ];
                }
            }
            $rowcount++;
        }
        return $errors;
    }

    /**
     * @return array|bool
     */
    private function parseFile() {
        if (!file_exists($this->file) || !is_readable($this->file)) {
            return FALSE;
        }

        $data = [];

        if (($handle = fopen($this->file, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 0, $this->delimiter, $this->enclosure, $this->escape)) !== FALSE) {
                $data[] = array_map('trim', $row); // trim every column
            }
            fclose($handle);
        }
        return $data;
    }

}