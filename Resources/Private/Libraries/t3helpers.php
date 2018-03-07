<?php

// ---------------------------------------------------------------------------------
// FILESYSTEM
// ---------------------------------------------------------------------------------

function t3h_getFilesByFolder($folder) {
    return \SaschaEnde\T3helpers\Utilities\Filesystem::getFilesByFolder($folder);
}

function t3h_getFileByID($id) {
    \SaschaEnde\T3helpers\Utilities\Filesystem::getFileByID($id);
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
    \SaschaEnde\T3helpers\Utilities\Data::sortArray($arr, $fields);
}

function t3h_arrayToObject($array){
    \SaschaEnde\T3helpers\Utilities\Data::arrayToObject($array);
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