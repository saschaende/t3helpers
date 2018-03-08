<?php

use SaschaEnde\T3helpers\Utilities\ConfigurationInterface;
use SaschaEnde\T3helpers\Utilities\DatabaseInterface;
use SaschaEnde\T3helpers\Utilities\DataInterface;
use SaschaEnde\T3helpers\Utilities\DebugInterface;
use SaschaEnde\T3helpers\Utilities\FilesystemInterface;
use SaschaEnde\T3helpers\Utilities\GoogleInterface;
use SaschaEnde\T3helpers\Utilities\InjectionsInterface;
use SaschaEnde\T3helpers\Utilities\LanguageInterface;
use SaschaEnde\T3helpers\Utilities\MailInterface;
use SaschaEnde\T3helpers\Utilities\PasswordInterface;
use SaschaEnde\T3helpers\Utilities\SessionInterface;
use SaschaEnde\T3helpers\Utilities\SettingsInterface;
use SaschaEnde\T3helpers\Utilities\TemplateInterface;
use SaschaEnde\T3helpers\Utilities\UriInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

// ---------------------------------------------------------------------------------
// FILESYSTEM
// ---------------------------------------------------------------------------------

function t3h_getFilesByFolder($folder) {
    /** @var FilesystemInterface $filesystem */
    $filesystem = t3h_injectClass(FilesystemInterface::class);
    return $filesystem->getFilesByFolder($folder);
}

function t3h_getFileByID($id) {
    /** @var FilesystemInterface $filesystem */
    $filesystem = t3h_injectClass(FilesystemInterface::class);
    return $filesystem->getFileByID($id);
}

function t3h_getFileExtPath($extension, $path) {
    /** @var FilesystemInterface $filesystem */
    $filesystem = t3h_injectClass(FilesystemInterface::class);
    return $filesystem->getFileExtPath($extension, $path);
}

// ---------------------------------------------------------------------------------
// CONFIGURATION
// ---------------------------------------------------------------------------------

function t3h_getExtensionConfiguration($ext) {
    /** @var \SaschaEnde\T3helpers\Utilities\ConfigurationInterface $configuration */
    $configuration = t3h_injectClass(ConfigurationInterface::class);
    $configuration->setExtension($ext);
    return $configuration->getAll();
}

function t3h_getExtensionConfigurationByKey($ext, $key) {
    /** @var \SaschaEnde\T3helpers\Utilities\ConfigurationInterface $configuration */
    $configuration = t3h_injectClass(ConfigurationInterface::class);
    $configuration->setExtension($ext);
    return $configuration->get($key);
}

// ---------------------------------------------------------------------------------
// SETTINGS
// ---------------------------------------------------------------------------------

/**
 * t3h_getPluginSettings('T3helpers','pluginname');
 * @param $extensionName
 * @param $pluginName
 * @return array
 */
function t3h_getPluginSettings($extensionName, $pluginName) {
    /** @var SettingsInterface $settings */
    $settings = t3h_injectClass(SettingsInterface::class);
    return $settings->getPlugin($extensionName, $pluginName);
}

// ---------------------------------------------------------------------------------
// DATA
// ---------------------------------------------------------------------------------

function t3h_sortArray($arr, $fields) {
    /** @var DataInterface $data */
    $data = t3h_injectClass(DataInterface::class);
    return $data->sortArray($arr, $fields);
}

function t3h_arrayToObject($array) {
    /** @var DataInterface $data */
    $data = t3h_injectClass(DataInterface::class);
    return $data->arrayToObject($array);
}

// ---------------------------------------------------------------------------------
// SESSION
// ---------------------------------------------------------------------------------

function t3h_getSession($extension, $key) {
    /** @var SessionInterface $session */
    $session = t3h_injectClass(SessionInterface::class);
    return $session->get($extension, $key);
}

function t3h_setSession($extension, $key, $value) {
    /** @var SessionInterface $session */
    $session = t3h_injectClass(SessionInterface::class);
    return $session->set($extension, $key, $value);
}

function t3h_isSession($extension, $key) {
    /** @var SessionInterface $session */
    $session = t3h_injectClass(SessionInterface::class);
    return $session->is($extension, $key);
}

// ---------------------------------------------------------------------------------
// DEBUG
// ---------------------------------------------------------------------------------

function t3h_debug($data) {
    /** @var DebugInterface $debug */
    $debug = t3h_injectClass(DebugInterface::class);
    $debug->output($data);
}

function t3h_debugMail($fromEmail, $recipientEmail, $data) {
    /** @var DebugInterface $debug */
    $debug = t3h_injectClass(DebugInterface::class);
    $debug->mailoutput($fromEmail, $recipientEmail, $data);
}

function t3h_debugFullTyposcript() {
    /** @var DebugInterface $debug */
    $debug = t3h_injectClass(DebugInterface::class);
    $debug->debugFullTyposcript();
}

// ---------------------------------------------------------------------------------
// MAIL
// ---------------------------------------------------------------------------------

function t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody) {
    /** @var MailInterface $mail */
    $mail = t3h_injectClass(MailInterface::class);
    return $mail->sendMail($recipient, $senderEmail, $senderName, $subject, $emailBody);
}

// ---------------------------------------------------------------------------------
// LANGUAGE
// ---------------------------------------------------------------------------------

function t3h_getCurrentLanguage() {
    /** @var LanguageInterface $language */
    $language = t3h_injectClass(LanguageInterface::class);
    return $language->current();
}

// ---------------------------------------------------------------------------------
// DATABASE
// ---------------------------------------------------------------------------------

function t3h_getQuerySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false) {
    /** @var DatabaseInterface $database */
    $database = t3h_injectClass(DatabaseInterface::class);
    return $database->querySettings($setRespectStoragePage, $setIgnoreEnableFields, $setIncludeDeleted);
}

function t3h_truncateTable($table) {
    /** @var DatabaseInterface $database */
    $database = t3h_injectClass(DatabaseInterface::class);
    $database->truncateTable($table);
}

// ---------------------------------------------------------------------------------
// LINK
// ---------------------------------------------------------------------------------

function t3h_getLinkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true) {
    /** @var UriInterface $uri */
    $uri = t3h_injectClass(UriInterface::class);
    return $uri->getByPid($pid, $useCacheHash, $forceAbsoluteUrl);
}

function t3h_getLinkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true) {
    /** @var UriInterface $uri */
    $uri = t3h_injectClass(UriInterface::class);
    return $uri->getByAction($pid, $extension, $controller, $action, $extraParameters, $typeNum, $useCacheHash, $forceAbsoluteUrl);
}

// ---------------------------------------------------------------------------------
// INJECTIONS
// ---------------------------------------------------------------------------------

function t3h_injectClass($class) {
    $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    return $objectManager->get($class);
}

function t3h_injectPhpFile($extension, $path) {
    /** @var InjectionsInterface $injections */
    $injections = t3h_injectClass(InjectionsInterface::class);
    $injections->phpFile($extension, $path);
}

// ---------------------------------------------------------------------------------
// GOOGLE
// ---------------------------------------------------------------------------------

function t3h_getGoogleGeoCoordinates($googleApiKey, $address) {
    /** @var GoogleInterface $google */
    $google = t3h_injectClass(GoogleInterface::class);
    return $google->getGeoCoordinates($googleApiKey, $address);
}

// ---------------------------------------------------------------------------------
// PASSWORDS
// ---------------------------------------------------------------------------------

function t3h_getEncryptedPassword($str) {
    /** @var PasswordInterface $password */
    $password = t3h_injectClass(PasswordInterface::class);
    return $password->getHashedPassword($str);
}

function t3h_getReadablePassword($letters = 8, $length = false) {
    /** @var PasswordInterface $password */
    $password = t3h_injectClass(PasswordInterface::class);
    return $password->createReadablePassword($letters, $length);
}

// ---------------------------------------------------------------------------------
// TEMPLATE
// ---------------------------------------------------------------------------------

function t3h_getTemplate($extension, $path, $variables = []){
    /** @var TemplateInterface $template */
    $template = t3h_injectClass(TemplateInterface::class);
    return $template->renderTemplate($extension, $path, $variables);
}