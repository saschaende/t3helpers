<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Csv implements SingletonInterface {

    protected $file;
    protected $rules;

    protected $patterns = [
        'any' => ['(.*)', 'is'],
        'text' => ['^([a-zA-Z0-9ßäöüÄÖÜ\s]+)$', 'is'],
        'number' => ['^([0-9]+){5}$', 'is'],
        'plz' => ['^([0-9]+){5}$', ''],
        'email' => ['^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$', 'i'],
        'date' => ['^([0-9]{2}.[0-9]{2}.[0-9]{4})$', 'is'],
        'anrede' => ['^(Herr|Frau)$', 'is']
    ];

    protected $delimiter = ',';
    protected $enclosure = '"';
    protected $escape = "\\";
    protected $autoUTF = true;

    /**
     * @param $file
     * @return $this
     */
    public function setFile($file) {
        $this->file = $file;
        return $this;
    }

    /**
     * @param bool $autoUTF
     * @return $this
     */
    public function setAutoUTF($autoUTF) {
        $this->autoUTF = $autoUTF;
        return $this;
    }


    /**
     * Get parsed file
     * @param bool $object Set true, to return std objects
     * @return array|bool|null
     */
    public function getFileParsed($object = false) {
        $fileParsed = $this->parseFile();

        if ($object) {

            $res = [];

            foreach ($fileParsed as $row) {

                $obj = new \stdClass();

                // Für jede Spalte
                for ($i = 0; $i < count($row); $i++) {
                    // Abbrechen, wenn keine Regel vorhanden
                    if (!$this->rules[$i]) {
                        continue;
                    }
                    // Daten hinzufügen
                    $obj->{$this->rules[$i]['column']} = $row[$i];
                }

                $res[] = $obj;
            }

            return $res;

        } else {
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
     * @param null $pos
     * @return $this|CsvInterface
     */
    public function addRule($column, $regex = 'any', $option = '', $emptyAllowed = false, $pos = null) {

        if ($this->patterns[$regex]) {
            $regex = $this->patterns[$regex][0];
            $option = $this->patterns[$regex][1];
        }

        if ($pos === null) {
            $this->rules[] = [
                'column' => $column,
                'regex' => $regex,
                'option' => $option,
                'emptyAllowed' => $emptyAllowed
            ];
        } else {
            $this->rules[$pos - 1] = [
                'column' => $column,
                'regex' => $regex,
                'option' => $option,
                'emptyAllowed' => $emptyAllowed
            ];
        }

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
                if ($output_array[0][0] != $row[$i] || ($this->rules[$i]['emptyAllowed'] == false && empty($row[$i]))) {
                    $errors[] = [
                        'row' => $rowcount,
                        'column' => $this->rules[$i]['column'],
                        'value' => $row[$i]
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

            while (($buffer = fgets($handle)) !== false) {

                if ($this->autoUTF) {
                    $buffer = t3h::Data()->autoUTF($buffer);
                }

                $row = str_getcsv($buffer, $this->delimiter, $this->enclosure, $this->escape);
                $row = array_map('trim', $row); // trim every column

                $data[] = $row;
            }

            fclose($handle);
        }
        return $data;
    }

}