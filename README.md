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

## Functions

A list of short functions you can use within your extensions:

### File System

* t3h_getFilesByFolder($folder)
* t3h_getFileByID($id)
* t3h_getFileExtPath($extension, $path)

### Database

* t3h_querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)

```
$query->setDefaultQuerySettings(t3h_querySettings(false,true,true));
```
* t3h_truncateTable($table)

### Data

* t3h_sortArray($arr, $fields)

```
$arr = t3h_sortArray(
    $arr,
    ['column' => 'asc']
);
```

* t3h_arrayToObject($array)

### Configuration (from EXT_CONF_TEMPLATE)

* t3h_getExtensionConfiguration($ext)
* t3h_getExtensionConfigurationByKey($ext,$key)

### Settings (from TYPOSCRIPT)

* t3h_getPluginSettings($extensionName, $pluginName)

### Session

* t3h_getSession($extension,$key)
* t3h_setSession($extension,$key,$value)
* t3h_isSession($extension,$key)

### Debug

* t3h_debug($data)
* t3h_debugMail($fromEmail,$recipientEmail,$data)
* t3h_debugFullTyposcript()

### Email

* t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody)

### Language

* t3h_getCurrentLanguage()

### Link

* t3h_getLinkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true)
* t3h_getLinkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true)

### Injections

* t3h_injectClass($class)
* t3h_injectPhpFile($extension,$path)

```
t3h_injectPhpFile('t3helpers','Resources/Private/Libraries/t3helpers.php');
```

### GOOGLE

* t3h_getGoogleGeoCoordinates($googleApiKey,$address)

### Passwords

* t3h_getEncryptedPassword($password)
* t3h_getReadablePassword($letters = 8, $length = false)

### Template

* t3h_getTemplate($extension, $path, $variables = [])

```
$html = t3h_getTemplate('t3helpers','Resources/Private/Templates/Mail.html');
```
