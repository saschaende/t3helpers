# T3Helpers - Helpers for TYPO3

* **Version**: v0.9.0
* **Last update**: 08.03.2018
* **CMS**: TYPO3
* **Type**: plugin
* **Description**: Helpers like in LARAVEL: Simple and easy functions that make your TYPO3 life with extbase and extension development a little easier.


## TODO

* [DOCS] Code examples and explainations for every function
* [TESTING] Test all functions for stable 1.0 release
* [FEATURE] SETTINGS: Get Template Root Paths for extension

## Changelog

* **08.03.2017** - DEBUG: Full Typoscript, (Max Schröter) Use Interfaces, so we can easily overwrite them: https://wiki.typo3.org/Dependency_Injection#Programming_against_interfaces, (Max Schröter) Convert static helper classes to abstractable normal classes, TEMPLATES: Render some Template with Variables
* **07.03.2017** - Bugfixes, Password functions added, Bugfixes, Injections added, Google added, t3h_truncateTable() added, Link helpers added

# Functions

A list of short functions you can use within your extensions:

## File System

##### t3h_getFilesByFolder($folder)

Get a list of files from a folder in fileadmin

##### t3h_getFileByID($id)

Get a file by file UID

##### t3h_getFileExtPath($extension, $path)

Get full path for a file in an extension directory

## Database

##### t3h_querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)

Use it for setting the three most used query settings when using database features.

```
$query->setDefaultQuerySettings(t3h_querySettings(false,true,true));
```
##### t3h_truncateTable($table)

Truncate a table (make it empty and reset increment counter)

## Data

##### t3h_sortArray($arr, $fields)

Sort a multidimensional way by keys

```
$arr = t3h_sortArray(
    $arr,
    ['column' => 'asc']
);
```

##### t3h_arrayToObject($array)

Convert an array to an object

## Configuration (from EXT_CONF_TEMPLATE)

##### t3h_getExtensionConfiguration($ext)

Get all the configuration settings for an extension

##### t3h_getExtensionConfigurationByKey($ext,$key)

Get only one configuration setting for $key (in most cases you dont need all)

## Settings (from TYPOSCRIPT)

##### t3h_getPluginSettings($extensionName, $pluginName)

Get plugin settings from TYPOSCRIPT. Normally ``plugin.plugin_name.settings`` or ``plugin.extension_name.settings`` 

## Session

##### t3h_getSession($extension,$key)

Get a value from session by extension name and key

##### t3h_setSession($extension,$key,$value)

Put data into the session by using extension name and a key

##### t3h_isSession($extension,$key)

Does a key exist?

## Debug

##### t3h_debug($data)

Shortcut for DebuggerUtility

##### t3h_debugMail($fromEmail,$recipientEmail,$data)

Get a print_r directly with mail

##### t3h_debugFullTyposcript()

Debug output the whole TYPOSCRIPT, that is actually defined

## Email

##### t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody)

Just send an email with one line

## Language

##### t3h_getCurrentLanguage()

Get the current language

## Link

##### t3h_getLinkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true)

Generate a link with PID

##### t3h_getLinkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true)

Generate a link with some more settings

## Injections

##### t3h_injectClass($class)

Inject a class by using object manager and dependency injection

##### t3h_injectPhpFile($extension,$path)

Inject a php file (for example with external function you want to use)

```
t3h_injectPhpFile('t3helpers','Resources/Private/Libraries/t3helpers.php');
```

## GOOGLE

##### t3h_getGoogleGeoCoordinates($googleApiKey,$address)

Get geo coordinates

## Passwords

##### t3h_getEncryptedPassword($password)

Get a salted and encrypted password for login

##### t3h_getReadablePassword($letters = 8, $length = false)

Get a human readable password

## Template

##### t3h_getTemplate($extension, $path, $variables = [])

Render a fluid template with online line of code - even outside a controller :)

```
$html = t3h_getTemplate('t3helpers','Resources/Private/Templates/Mail.html');
```
