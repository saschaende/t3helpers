<?php

namespace SaschaEnde\T3helpers\Utilities;

use function GuzzleHttp\Psr7\parse_query;
use SaschaEnde\T3helpers\Vendor\Encoding;
use t3h\t3h;
use t3h\XML2Array;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Data implements SingletonInterface {

    protected $xml;

    /**
     * Example: t3h::Data()->sortObjectStorage($users,'getUsername','asc')
     * @param $object
     * @param $function
     * @param string $ordering
     * @return ObjectStorage
     */
    public function sortObjectStorage($object, $function, $ordering = 'asc') {
        $array = [];
        foreach ($object as $elm) {
            $array[] = [
                'object' => $elm,
                'sort' => str_replace([' ','Š'],['','S'],strtoupper($elm->$function()))
            ];
        }
        $array = $this->sortArray($array, ['sort' => $ordering]);

        $storage = new ObjectStorage();
        foreach ($array as $elm) {
            $storage->attach($elm['object']);
        }
        return $storage;
    }

    /**
     * @param $arr
     * @param $fields
     * @return mixed
     */
    public function sortArray($arr, $fields) {
        $sortFields = array();
        $args = array();

        foreach ($arr as $key => $row) {
            foreach ($fields as $field => $order) {
                $sortFields[$field][$key] = $row[$field];
            }
        }

        foreach ($fields as $field => $order) {
            $args[] = $sortFields[$field];

            if (is_array($order)) {
                foreach ($order as $pt) {
                    $args[$pt];
                }
            } else {
                $args[] = ($order == 'asc' || $order == 'ASC' || $order == SORT_ASC) ? SORT_ASC : SORT_DESC;
            }
        }

        $args[] = &$arr;

        call_user_func_array('array_multisort', $args);

        return $arr;
    }

    /**
     * @param $array
     * @return \stdClass
     */
    public function arrayToObject($array) {
        $obj = new \stdClass();
        foreach ($array as $key => $value) {
            $obj->{$key} = $value;
        }
        return $obj;
    }

    /**
     * @param $array
     * @return \stdClass
     */
    public function arrayToObjectStorage($array) {
        $obj = new ObjectStorage();
        foreach ($array as $element) {
            $obj->attach($element);
        }
        return $obj;
    }

    /**
     * Create an array from xml string - cause GeneralUtility::xml2array is buggy with some xml structures
     * @param $xmldata
     * @return \t3h\DOMDocument
     */
    public function xmlToArray($xmldata) {
        t3h::Inject()->setExtension('t3helpers')->phpFile('Resources/Private/Libraries/XML2Array.php');
        return XML2Array::createArray($xmldata);
    }

    /**
     * The main function for converting to an XML document.
     * Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.
     *
     * @param array $data
     * @param string $rootNodeName - what you want the root node to be - defaultsto data.
     * @param SimpleXMLElement $xml - should only be used recursively
     * @return string XML
     */
    public function arrayToXml($data, $rootNodeName = 'data', $xml = null) {
        // turn off compatibility mode as simple xml throws a wobbly if you don't.
        if (ini_get('zend.ze1_compatibility_mode') == 1) {
            ini_set('zend.ze1_compatibility_mode', 0);
        }

        if ($xml == null) {
            $xml = simplexml_load_string("<?xml version='1.0' encoding='utf-8'?><$rootNodeName />");
        }

        // loop through the data passed in.
        foreach ($data as $key => $value) {
            // no numeric keys in our xml please!
            if (is_numeric($key)) {
                // make string key...
                $key = "entry" . (string)$key;
            }

            // replace anything not alpha numeric
            $key = preg_replace('/[^a-z]/i', '', $key);

            // if there is another array found recrusively call this function
            if (is_array($value)) {
                $node = $xml->addChild($key);
                // recrusive call.
                $this->arrayToXml($value, $rootNodeName, $node);
            } else {
                // add single node.
                $value = htmlentities($value, ENT_XML1);
                $xml->addChild($key, $value);
            }

        }
        // pass back as string. or simple xml object if you want!
        return $xml->asXML();
    }


    /**
     * Format html code with RTE features
     * @param $str
     * @return string
     */
    public function formatRTE($str) {
        /** @var ConfigurationManagerInterface $configurationManager */
        $configurationManager = t3h::injectClass(ConfigurationManagerInterface::class);
        $output = $configurationManager->getContentObject()->parseFunc($str, array(), '< lib.parseFunc_RTE');
        return $output;
    }

    /**
     * automatic convertion info utf-8 string
     * @param string $s
     * @return  string
     */
    public function autoUTF($s) {
        return Encoding::toUTF8($s);
    }

    /**
     * @param $url
     * @return mixed
     */
    public function get_youtube_id_from_url($url) {
        preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $url, $results);
        return $results[6];
    }

    /**
     * Extended version of parse_url
     * @param $url
     */
    public function parse_url($url) {
        $parseData = parse_url($url);

        // google Webcache?
        if ($parseData['host'] == 'webcache.googleusercontent.com') {
            $querydata = parse_query($parseData['query']);
            $domain = explode(':', $querydata['q']);
            $domain = array_slice($domain, 2);
            $domain = urldecode(trim(implode(':', $domain)));

            if (substr($domain, 0, 4) != 'http') {
                $domain = 'http://' . $domain;
            }
            $parseData = parse_url($domain);
        }

        if ($parseData['scheme'] == 'https') {
            $parseData['ssl'] = true;
        } else {
            $parseData['ssl'] = false;
        }

        // Queries
        if (isset($parseData['query'])) {
            $parseData['queryData'] = parse_query($parseData['query']);
        } else {
            $parseData['queryData'] = [];
        }

        // Extract Subdomain
        $domainparts = explode('.', $parseData['host']);
        $parseData['domain'] = $domainparts[count($domainparts) - 2] . '.' . $domainparts[count($domainparts) - 1];

        if (count($domainparts) > 2) {
            $parseData['subdomain'] = str_replace('.' . $parseData['domain'], '', $parseData['host']);
        } else {
            $parseData['subdomain'] = '';
        }


        // URI 1
        $uri = $parseData['domain'] . $parseData['path'];
        if (isset($parseData['query'])) {
            $uri .= '?' . $parseData['query'];
        }
        $parseData['domainPath'] = $uri;

        // URI 2
        $uri = $parseData['host'] . $parseData['path'];
        if (isset($parseData['query'])) {
            $uri .= '?' . $parseData['query'];
        }
        $parseData['hostPath'] = $uri;

        // URI 3
        $uri = $parseData['path'];
        if (isset($parseData['query'])) {
            $uri .= '?' . $parseData['query'];
        }
        $parseData['queryPath'] = $uri;


        return $parseData;
    }

    /**
     * Recursive Generate Array from Object(supports ObjectStorage and Domain Models)
     * @param $obj
     * @param int $maxlevels
     * @param array $unwanted_keys
     * @param int $level
     * @return array|mixed
     */
    public function objectToArray($obj, $maxlevels = 999, $unwanted_keys = [], $level = 1) {
        //only process if it's an object or array being passed to the function
        if (is_object($obj) || is_array($obj)) {
            if (method_exists($obj, 'getArray')) {
                $ret = $obj->getArray();
            } elseif (method_exists($obj, '_getProperties')) {
                $ret = $obj->_getProperties();
            } else {
                $ret = (array) $obj;
            }

            foreach ($ret as &$item) {
                if ($level < $maxlevels) {
                    //recursively process EACH element regardless of type
                    $item = $this->objectToArray($item, $maxlevels, $unwanted_keys,$level + 1);
                }
            }

            $this->recursiveUnset($ret,$unwanted_keys);

            $ret = json_decode(json_encode($ret),true);
            $this->recursiveUnset($ret,$unwanted_keys);
            return $ret;
        }
        //otherwise (i.e. for scalar values) return without modification
        else {
            return $obj;
        }
    }

    /**
     * Erhalte Properties einer Klasse als Array
     * @param $class
     * @param array $props
     */
    public function getFilteredClassProperties($class,array $props){
        $return = [];
        foreach($props as $prop){
            if(method_exists($class,'get'.$prop)){
                $method = 'get'.$prop;
                $return[$prop] = $class->$method();
            }
            else if(method_exists($class,'is'.$prop)){
                $method = 'is'.$prop;
                $return[$prop] = $class->$method();
            }
        }
        return $return;
    }

    /**
     * Rekuscive unset of keys from an array
     * @param $array
     * @param array $unwanted_keys
     */
    public function recursiveUnset(&$array, $unwanted_keys = []) {
        foreach($unwanted_keys as $key){
            unset($array[$key]);
        }
        foreach ($array as &$value) {
            if (is_array($value)) {
                $this->recursiveUnset($value, $unwanted_keys);
            }
        }
    }

    function getSlug($text)
    {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
    }

    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * This function uses type hints now (PHP 7+ only), but it was originally
     * written for PHP 5 as well.
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    function random_str(
        int $length = 64,
        string $keyspace = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

}