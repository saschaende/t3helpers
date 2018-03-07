# T3Helpers - Helpers for TYPO3

* **Version**: v0.0.6
* **Last update**: 07.03.2018
* **CMS**: TYPO3
* **Type**: plugin
* **Description**: Simple and easy functions that make your TYPO3 life a little easier.

## Changelog

* **v0.0.6:**  Password functions added, Bugfixes
* **v0.0.5:**  Injections added, Google added, t3h_truncateTable() added
* **v0.0.4:**  Link helpers added

## Functions

### File System

* t3h_getFilesByFolder($folder)
* t3h_getFileByID($id)

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

### Session

* t3h_debug($data)
* t3h_debugMail($fromEmail,$recipientEmail,$data)

### Email

* t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody)

### Language

* t3h_language()

### Link

* t3h_linkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true)
* t3h_linkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true)

### Injections

* t3h_injectPhpFile($extension,$path)

```
t3h_injectPhpFile('t3helpers','Resources/Private/Libraries/t3helpers.php');
```

### GOOGLE

* t3h_getGoogleGeoCoordinates($googleApiKey,$address)

### Passwords

* t3h_encryptPassword($password)
* t3h_getReadablePassword($letters = 8, $length = false)
