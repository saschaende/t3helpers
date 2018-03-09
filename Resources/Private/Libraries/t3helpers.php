<?php

namespace T3h;

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

/**
 * @return FilesystemInterface
 */
function Filesystem() {
    return injectClass(FilesystemInterface::class);
}

/**
 * @return ConfigurationInterface
 */
function Configuration() {
    return injectClass(ConfigurationInterface::class);
}

/**
 * @return SettingsInterface
 */
function Settings() {
    return injectClass(SettingsInterface::class);
}

/**
 * @return DataInterface
 */
function Data() {
    return injectClass(DataInterface::class);
}

/**
 * @return SessionInterface
 */
function Session() {
    return injectClass(SessionInterface::class);
}

/**
 * @return MailInterface
 */
function Mail() {
    return injectClass(MailInterface::class);
}

/**
 * @return LanguageInterface
 */
function Language() {
    return injectClass(LanguageInterface::class);
}

/**
 * @return DatabaseInterface
 */
function Database() {
    return injectClass(DatabaseInterface::class);
}

/**
 * @return UriInterface
 */
function Link() {
    return injectClass(UriInterface::class);
}

/**
 * @return InjectionsInterface
 */
function Inject() {
    return injectClass(InjectionsInterface::class);
}

/**
 * @return GoogleInterface
 */
function Google() {
    return injectClass(GoogleInterface::class);
}

/**
 * @return PasswordInterface
 */
function Password() {
    return injectClass(PasswordInterface::class);
}

/**
 * @return TemplateInterface
 */
function Template() {
    return injectClass(TemplateInterface::class);
}

// ---------------------------------------------------------------------------------
// DEBUG
// ---------------------------------------------------------------------------------

function debug($data) {
    /** @var DebugInterface $debug */
    $debug = injectClass(DebugInterface::class);
    $debug->output($data);
}

function debugMail($fromEmail, $recipientEmail, $data) {
    /** @var DebugInterface $debug */
    $debug = injectClass(DebugInterface::class);
    $debug->mailoutput($fromEmail, $recipientEmail, $data);
}

function debugFullTyposcript() {
    /** @var DebugInterface $debug */
    $debug = injectClass(DebugInterface::class);
    $debug->debugFullTyposcript();
}

// ---------------------------------------------------------------------------------
// Objectmanager
// ---------------------------------------------------------------------------------

function injectClass($class) {
    $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    return $objectManager->get($class);
}