# T3Helpers - Helpers for TYPO3

Small and leightweight helper functions

## File System

* t3h_getFilesByFolder($folder)
* t3h_getFileByID($id)

## Database

* t3h_querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)

## Data

* t3h_sortArray($arr, $fields)

```
$arr = t3h_sortArray(
    $arr,
    ['column' => 'asc']
);
```

* t3h_arrayToObject($array)

## Configuration (from EXT_CONF_TEMPLATE)

* t3h_getExtensionConfiguration($ext)
* t3h_getExtensionConfigurationByKey($ext,$key)

## Settings (from TYPOSCRIPT)

* t3h_getPluginSettings($extensionName, $pluginName)

## Session

* t3h_getSession($extension,$key)
* t3h_setSession($extension,$key,$value)
* t3h_isSession($extension,$key)

## Session

* t3h_debug($data)
* t3h_debugMail($fromEmail,$recipientEmail,$data)

## Email

* t3h_mail($recipient, $senderEmail, $senderName, $subject, $emailBody)

## Language

* t3h_language()