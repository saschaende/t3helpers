# T3Helpers - Helpers for TYPO3

**Important: During BETA everything can change. Please wait some days until the final stable version is ready to use.**

* **Version**: v0.9.0
* **Last update**: 08.03.2018
* **CMS**: TYPO3
* **Type**: plugin
* **Description**: Helpers like in LARAVEL: Simple and easy functions that make your TYPO3 life with extbase and extension development a little easier.


# TODO FOR FINAL STABLE RELEASE

* [BIG CHANGE] Remove functions, use Shortcuts like T3hSessions()->get() or T3hDatabase()->truncateTable($table)
* [DOCS] Code examples and explainations for every function
* [TESTING] Test all functions for stable 1.0 release
* [FEATURE] SETTINGS: Get Template Root Paths for extension

# Changelog

* **08.03.2017** - DEBUG: Full Typoscript, (Max Schröter) Use Interfaces, so we can easily overwrite them: https://wiki.typo3.org/Dependency_Injection#Programming_against_interfaces, (Max Schröter) Convert static helper classes to abstractable normal classes, TEMPLATES: Render some Template with Variables
* **07.03.2017** - Bugfixes, Password functions added, Bugfixes, Injections added, Google added, t3h_truncateTable() added, Link helpers added

# Installation

## Composer

* https://packagist.org/packages/saschaende/t3helpers

``composer require saschaende/t3helpers``

# Features

A list of short functions you can use within your extensions:

## t3h::Filesystem()

#### t3h::Filesystem()->getFilesByFolder($folder)

Get a list of files from a folder in fileadmin

```
$files = t3h::Filesystem()->getFilesByFolder('fileadmin/user_upload/Bilderslider');
```

#### t3h::Filesystem()->getFileByID($id)

Get a file by file UID

````
$file = t3h::Filesystem()->getFileByID(14);
````

#### t3h::Filesystem()->getFileExtPath($extension, $path)

Get full path for a file in an extension directory

````
$filePath = t3h::Filesystem()->getFileExtPath('t3helpers','Resources/Private/Libraries/t3helpers.php');
// Will output: 'C:/xampp/htdocs/typo3/typo3conf/ext/t3helpers/Resources/Private/Libraries/t3helpers.php'
````

#### Overview / Latest functionality tests

Function | TYPO3 Version test | Test date
------------- |------------- | ------------------
t3h::Filesystem()->getFilesByFolder($folder)      |  8.7.10 | 09.03.2017 
t3h::Filesystem()->getFileByID($id)     |  8.7.10 | 09.03.2017
t3h::Filesystem()->getFileExtPath($extension, $path) |  8.7.10 | 09.03.2017

## t3h::Database()

#### t3h::Database()->querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)

Use it for setting the three most used query settings when using database features.

```
$this->musicRepository->setDefaultQuerySettings(t3h::Database()->querySettings(false,true,true));
```
#### t3h::Database()->truncateTable($table)

Truncate a table (make it empty and reset increment counter)

#### Overview / Latest functionality tests

Function | TYPO3 Version test | Test date
------------- |------------- | ------------------
t3h::Database()->querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)     |  - | - 
t3h::Database()->truncateTable($table)     |  - | -

## Data

#### t3h_sortArray($arr, $fields)

Sort a multidimensional way by keys

```
$arr = t3h_sortArray(
    $arr,
    ['column' => 'asc']
);
```

#### t3h_arrayToObject($array)

Convert an array to an object

## Configuration (from EXT_CONF_TEMPLATE)

#### t3h_getExtensionConfiguration($ext)

Get all the configuration settings for an extension

#### t3h_getExtensionConfigurationByKey($ext,$key)

Get only one configuration setting for $key (in most cases you dont need all)

## Settings (from TYPOSCRIPT)

#### t3h_getPluginSettings($extensionName, $pluginName)

Get plugin settings from TYPOSCRIPT. Normally ``plugin.plugin_name.settings`` or ``plugin.extension_name.settings`` 

## Session

#### t3h_getSession($extension,$key)

Get a value from session by extension name and key

#### t3h_setSession($extension,$key,$value)

Put data into the session by using extension name and a key

#### t3h_isSession($extension,$key)

Does a key exist?

## Debug

#### t3h_debug($data)

Shortcut for DebuggerUtility

#### t3h_debugMail($fromEmail,$recipientEmail,$data)

Get a print_r directly with mail

#### t3h_debugFullTyposcript()

Debug output the whole TYPOSCRIPT, that is actually defined

## Email

#### t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody)

Just send an email with one line

## Language

#### t3h_getCurrentLanguage()

Get the current language

## Link

#### t3h_getLinkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true)

Generate a link with PID

#### t3h_getLinkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true)

Generate a link with some more settings

## Injections

#### t3h_injectClass($class)

Inject a class by using object manager and dependency injection

#### t3h_injectPhpFile($extension,$path)

Inject a php file (for example with external function you want to use)

```
t3h_injectPhpFile('t3helpers','Resources/Private/Libraries/t3helpers.php');
```

## GOOGLE

#### t3h_getGoogleGeoCoordinates($googleApiKey,$address)

Get geo coordinates

## Passwords

#### t3h_getEncryptedPassword($password)

Get a salted and encrypted password for login

#### t3h_getReadablePassword($letters = 8, $length = false)

Get a human readable password

## Template

#### t3h_getTemplate($extension, $path, $variables = [])

Render a fluid template with online line of code - even outside a controller :)

```
$html = t3h_getTemplate('t3helpers','Resources/Private/Templates/Mail.html');
```
