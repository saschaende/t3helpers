<?php

namespace SaschaEnde\T3helpers\Utilities;

class Request {

    protected $cookiesession = null;
    protected $usecookiesession = false;
    protected $userAgent = '';
    protected $debug = false;
    protected $postData = [];
    protected $type = 'GET';
    protected $url = '';
    protected $followLocation = true;
    protected $additionalCookies = ''; // cookiename=cookievalue
    protected $result = [];
    protected $headers = [];
    protected $json = false;
    protected $err;
    protected $errmsg;


    protected function log($url,$input,$output){
        $input = @htmlspecialchars($input);
        $output = @htmlspecialchars($output);
        if($this->isDebug()){
            echo '<p>';
            echo '<b>'.$url.'</b>';
            echo '<p>INPUT: '.print_r($input,true).'</p>';
            echo '<p>OUTPUT: '.print_r($output,true).'</p>';
            echo '</p><hr>';
        }
    }

    /**
     * @param bool $usecookiesession
     */
    public function setUsecookiesession(bool $usecookiesession): void {
        $this->usecookiesession = $usecookiesession;
    }

    /**
     * Get a new fresh cookie session
     * @return string|null
     * @todo Set TYPO3 temp path here
     */
    protected function getCookieSession() {

        $dir = dirname(__FILE__) . '/cookies/';
        $cookiePath = $dir.uniqid() . '.txt';

        if(!is_writable($dir)){
            echo '<b>Cookie caching:</b> '.$dir.' has no write access<br>';
            exit;
        }

        if ($this->cookiesession === null) {
            $this->setCookiesession($cookiePath);
        }
        return $this->cookiesession;
    }

    /**
     * @return bool
     */
    public function isDebug() {
        return $this->debug;
    }

    /**
     * @param bool $debug
     */
    public function setDebug($debug) {
        $this->debug = $debug;
    }


    /**
     * Delete cookie session when deconstructing
     */
    public function __destruct() {
        if($this->usecookiesession){
            unlink($this->getCookieSession());
        }
    }

    /**
     * @param null $cookiesession
     */
    protected function setCookiesession($cookiesession) {
        $this->cookiesession = $cookiesession;
    }

    /**
     * @return string
     */
    protected function getUserAgent() {
        return $this->userAgent;
    }

    /**
     * Inject the cookie session into the curl request
     * @param $handle
     */
    protected function injectCookieSession(&$handle){
        // additional for storing cookie
        curl_setopt($handle, CURLOPT_COOKIEJAR, $this->getCookieSession());
        curl_setopt($handle, CURLOPT_COOKIEFILE, $this->getCookieSession());
    }

    /**
     * @return $this
     */
    public function request(){

        $handle = curl_init($this->url);

        $options = array(
            CURLOPT_RETURNTRANSFER => true, // to return web page
            CURLOPT_HTTPHEADER => $this->getHeaders(),
            CURLOPT_HEADER => true, // to return headers in addition to content
            CURLOPT_FOLLOWLOCATION => $this->isFollowLocation(), // to follow redirects
            CURLOPT_ENCODING => "",   // to handle all encodings
            CURLOPT_AUTOREFERER => true, // to set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,  // set a timeout on connect
            CURLOPT_TIMEOUT => 120,  // set a timeout on response
            CURLOPT_MAXREDIRS => 10,   // to stop after 10 redirects
            CURLINFO_HEADER_OUT => true, // no header out
            CURLOPT_SSL_VERIFYPEER => false,// to disable SSL Cert checks
            CURLOPT_USERAGENT => $this->getUserAgent(), // Set User Agent
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_COOKIE => $this->getAdditionalCookies()
        );
        curl_setopt_array($handle, $options);

        if($this->getType() == 'POST'){
            curl_setopt($handle,CURLOPT_CUSTOMREQUEST,'POST');
            curl_setopt($handle,CURLOPT_POST,true);
            curl_setopt($handle,CURLOPT_POSTFIELDS,http_build_query($this->getPostData()));
        }else{
            curl_setopt($handle,CURLOPT_CUSTOMREQUEST,$this->type);
        }

        // additional for storing cookie
        if($this->usecookiesession){
            $this->injectCookieSession($handle);
        }

        $raw_content = curl_exec($handle);

        $this->setErr(curl_errno($handle));
        $this->setErrmsg(curl_error($handle));

        $header = curl_getinfo($handle);
        curl_close($handle);

        $header_content = substr($raw_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $raw_content));

        // let's extract cookie from raw content for the viewing purpose
        $cookiepattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($cookiepattern, $header_content, $matches);
        $cookies = [];
        foreach($matches['cookie'] as $match){
            preg_match('/(.*)=(.*)/', $match, $cookieParsed);
            $cookies[$cookieParsed[1]] = $cookieParsed[2];
        }

        $header['headers'] = $header_content;
        $header['content'] = $body_content;
        $header['cookies'] = $cookies;

        $this->log($this->url,$this->postData,$header['content']);

        // Save Results
        $this->setResult($header);

        return $this;
    }

    /**
     * @return array
     */
    protected function getPostData() {
        return $this->postData;
    }

    /**
     * @param $postData
     * @return $this
     */
    public function setPostData($postData) {
        $this->postData = $postData;
        return $this;
    }

    /**
     * @return string
     */
    protected function getType() {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    protected function getUrl() {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url) {

        // Reset all settings
        $this->postData = [];
        $this->type = 'GET';
        $this->url = '';
        $this->followLocation = true;
        $this->additionalCookies = ''; // cookiename=cookievalue
        $this->result = [];
        $this->headers = [];
        $this->json = false;

        // set new url
        $this->url = $url;
        return $this;
    }

    /**
     * @return bool
     */
    protected function isFollowLocation() {
        return $this->followLocation;
    }

    /**
     * @param $followLocation
     * @return $this
     */
    public function setFollowLocation($followLocation) {
        $this->followLocation = $followLocation;
        return $this;
    }

    /**
     * @return string
     */
    protected function getAdditionalCookies() {
        return $this->additionalCookies;
    }

    /**
     * @param $additionalCookies
     * @return $this
     */
    public function setAdditionalCookies($additionalCookies) {
        $this->additionalCookies = $additionalCookies;
        return $this;
    }

    /**
     * @return array
     */
    protected function getHeaders() {
        return $this->headers;
    }

    /**
     * @param $headers
     * @return $this
     */
    public function setHeaders($headers) {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return array
     */
    public function getResult($type = 'content') {
        if($this->isJson()){
            return json_decode($this->result[$type],true);
        }
        return $this->result[$type];
    }

    /**
     * @param array $result
     */
    protected function setResult($result) {
        $this->result = $result;
    }

    /**
     * @return bool
     */
    protected function isJson() {
        return $this->json;
    }

    /**
     * @param $jsonDecode
     * @return $this
     */
    public function setJson() {
        $this->json = true;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErr() {
        return $this->err;
    }

    /**
     * @param mixed $err
     */
    protected function setErr($err) {
        $this->err = $err;
    }

    /**
     * @return mixed
     */
    public function getErrmsg() {
        return $this->errmsg;
    }

    /**
     * @param mixed $errmsg
     */
    protected function setErrmsg($errmsg) {
        $this->errmsg = $errmsg;
    }

}