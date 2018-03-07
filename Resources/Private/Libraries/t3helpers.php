<?php

// ---------------------------------------------------------------------------------
// FILESYSTEM
// ---------------------------------------------------------------------------------

function t3h_getFilesByFolder($folder) {
    return \SaschaEnde\T3helpers\Utilities\Filesystem::getFilesByFolder($folder);
}

function t3h_getFileByID($id) {
    return \SaschaEnde\T3helpers\Utilities\Filesystem::getFileByID($id);
}

// ---------------------------------------------------------------------------------
// CONFIGURATION
// ---------------------------------------------------------------------------------

function t3h_getExtensionConfiguration($ext){
    \SaschaEnde\T3helpers\Utilities\Configuration::setExtension($ext);
    return \SaschaEnde\T3helpers\Utilities\Configuration::getAll();
}

function t3h_getExtensionConfigurationByKey($ext,$key){
    \SaschaEnde\T3helpers\Utilities\Configuration::setExtension($ext);
    return \SaschaEnde\T3helpers\Utilities\Configuration::get($key);
}

// ---------------------------------------------------------------------------------
// SETTINGS
// ---------------------------------------------------------------------------------

/**
 * t3h_getPluginSettings('SeMusicdirectory','searchresults');
 * @param $extensionName
 * @param $pluginName
 * @return array
 */
function t3h_getPluginSettings($extensionName, $pluginName){
    return \SaschaEnde\T3helpers\Utilities\Settings::getPlugin($extensionName, $pluginName);
}

// ---------------------------------------------------------------------------------
// DATA
// ---------------------------------------------------------------------------------

function t3h_sortArray($arr, $fields) {
    return \SaschaEnde\T3helpers\Utilities\Data::sortArray($arr, $fields);
}

function t3h_arrayToObject($array){
    return \SaschaEnde\T3helpers\Utilities\Data::arrayToObject($array);
}

// ---------------------------------------------------------------------------------
// SESSION
// ---------------------------------------------------------------------------------

function t3h_getSession($extension,$key){
    return \SaschaEnde\T3helpers\Utilities\Session::get($extension,$key);
}

function t3h_setSession($extension,$key,$value){
    return \SaschaEnde\T3helpers\Utilities\Session::set($extension,$key,$value);
}

function t3h_isSession($extension,$key){
    return \SaschaEnde\T3helpers\Utilities\Session::is($extension,$key);
}

// ---------------------------------------------------------------------------------
// DEBUG
// ---------------------------------------------------------------------------------

function t3h_debug($data){
    \SaschaEnde\T3helpers\Utilities\Debug::output($data);
}

function t3h_debugMail($fromEmail,$recipientEmail,$data){
    \SaschaEnde\T3helpers\Utilities\Debug::mailoutput($fromEmail,$recipientEmail,$data);
}

// ---------------------------------------------------------------------------------
// MAIL
// ---------------------------------------------------------------------------------

function t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody){
    return \SaschaEnde\T3helpers\Utilities\Mail::sendMail($recipient, $senderEmail, $senderName, $subject, $emailBody);
}

// ---------------------------------------------------------------------------------
// LANGUAGE
// ---------------------------------------------------------------------------------

function t3h_language(){
    return \SaschaEnde\T3helpers\Utilities\Language::current();
}

// ---------------------------------------------------------------------------------
// DATABASE
// ---------------------------------------------------------------------------------

function t3h_querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false){
    return \SaschaEnde\T3helpers\Utilities\Database::querySettings($setRespectStoragePage, $setIgnoreEnableFields, $setIncludeDeleted);
}

function t3h_truncateTable($table){
    \SaschaEnde\T3helpers\Utilities\Database::truncateTable($table);
}

// ---------------------------------------------------------------------------------
// LINK
// ---------------------------------------------------------------------------------

function t3h_linkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true){
    return \SaschaEnde\T3helpers\Utilities\Uri::getByPid($pid, $useCacheHash, $forceAbsoluteUrl);
}

function t3h_linkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true){
    return \SaschaEnde\T3helpers\Utilities\Uri::getByAction($pid, $extension, $controller, $action, $extraParameters, $typeNum, $useCacheHash, $forceAbsoluteUrl);
}

// ---------------------------------------------------------------------------------
// INJECTIONS
// ---------------------------------------------------------------------------------

function t3h_injectPhpFile($extension,$path){
    \SaschaEnde\T3helpers\Utilities\Injections::phpFile($extension,$path);
}

// ---------------------------------------------------------------------------------
// GOOGLE
// ---------------------------------------------------------------------------------

function t3h_getGoogleGeoCoordinates($googleApiKey,$address){
    \SaschaEnde\T3helpers\Utilities\Google::getGeoCoordinates($googleApiKey,$address);
}

// ---------------------------------------------------------------------------------
// PASSWORDS
// ---------------------------------------------------------------------------------

function t3h_encryptPassword($password){
    return \SaschaEnde\T3helpers\Utilities\Password::getHashedPassword($password);
}

function t3h_getReadablePassword($letters = 8, $length = false){
    return \SaschaEnde\T3helpers\Utilities\Password::createReadablePassword($letters, $length);
}