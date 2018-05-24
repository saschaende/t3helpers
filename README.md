# T3Helpers - Helpers for TYPO3

Helpers for Extbase: Simple and easy functions that make your TYPO3 life with extbase and extension development a little easier. Please let me know if you have any ideas or if you find any errors, i will fix this immediately.

* **CMS**: TYPO3
* **Type**: plugin

# Changelog

* **24.05.2018** - [0.9.9] Database()->getQuerybuilder($table, $addFrom = true)
* **23.05.2018** - [0.9.8] Data()->xmlToArray($xmldata)
* **22.04.2018** - [0.9.6] Filesystem->fileExists($folder,$fileName)
* **04.04.2018** - models and repositories for pages, contents / content element object viewhelper / Filesystem::getFileObjectByID($id) / phpdoc comments for Filesystem / Link()->Uri() / Link() is deprecated / t3h::Category()
* **03.04.2018** - Filesystem::getCategoriesForFile($uid)
* **31.03.2018** - Bugfixes & enhancements
* **22.03.2018** - Many changes and enhancements
* **09.03.2018** - First cleanup and documentation, new functions, tests
* **08.03.2018** - DEBUG: Full Typoscript, (Max Schröter) Use Interfaces, so we can easily overwrite them: https://wiki.typo3.org/Dependency_Injection#Programming_against_interfaces, (Max Schröter) Convert static helper classes to abstractable normal classes, TEMPLATES: Render some Template with Variables
* **07.03.2018** - Bugfixes, Password functions added, Bugfixes, Injections added, Google added, t3h_truncateTable() added, Link helpers added

# Installation

## Composer

* https://packagist.org/packages/saschaende/t3helpers

``composer require saschaende/t3helpers``

# Features

Some short functions you can use within your extensions (and many more...):


## Filesystem

#### getFilesByFolder($folder)

> Get a list of files from a folder in fileadmin

```
$files = t3h::Filesystem()->getFilesByFolder('fileadmin/user_upload/Bilderslider');
```

#### getFileByID($id)

> Get a file by file UID

````
$file = t3h::Filesystem()->getFileByID(14);
````

#### getFileExtPath($extension, $path)

> Get full path for a file in an extension directory

````
$filePath = t3h::Filesystem()->getFileExtPath('t3helpers','Resources/Private/Libraries/t3helpers.php');
// Will output: 'C:/xampp/htdocs/typo3/typo3conf/ext/t3helpers/Resources/Private/Libraries/t3helpers.php'
````







## Database

#### querySettings($setRespectStoragePage = false, $setIgnoreEnableFields = false, $setIncludeDeleted = false)

> Use it for setting the three most used query settings when using database features.

```
$this->musicRepository->setDefaultQuerySettings(t3h::Database()->querySettings(false,true,true));
```
#### truncateTable($table)

> Truncate a table (make it empty and reset increment counter)







## Data

#### sortArray($arr, $fields)

> Sort a multidimensional way by keys

```
$arr = t3h::sortArray(
    $arr,
    ['column' => 'asc']
);
```

#### arrayToObject($array)

> Convert an array to an object







## Configuration (from EXT_CONF_TEMPLATE)

#### setExtension($ext)

> Set the extension name.

#### getAll()

> Get all the configuration settings for an extension

#### get($propertyName)

> Get only one configuration setting for $key (in most cases you dont need all)






## Settings (from TYPOSCRIPT)

#### getPlugin($extensionName, $pluginName)

> Get plugin settings from TYPOSCRIPT. Normally ``plugin.plugin_name.settings`` or ``plugin.extension_name.settings`` 

````
// Do not use "tx_" in the extension name
$settings = t3h::Settings()->getPlugin('semusicdirectory','Searchresults');
t3h::Debug()->dump($settings); // will ne null, if there are no settings
````








## Session

T3h is grouping your session data by extension name - so there will be no conflicts with other extensions.

#### setExtension($extension)

> Get a value from session by extension name and key

#### get($key)

> Get a value from session by extension name and key

#### set($key, $value)

> Put data into the session by using extension name and a key

#### exists($key)

> Does a key exist?

````
// Some examples with sessions and combination of functions
t3h::Session()->setExtension('t3helpers')->set('testing1', ['key' => 'value']);
t3h::Session()->set('testing2','bla');
t3h::Session()->setExtension('secondextension')->set('testing3','otherextension');

t3h::Session()->setExtension('t3helpers');
t3h::Debug()->dump(t3h::Session()->get('testing1'));
t3h::Debug()->dump(t3h::Session()->get('testing2'));

t3h::Debug()->dump(t3h::Session()->setExtension('secondextension')->get('testing3'));
````






## Debug

#### dump($data,$split = false)

> Shortcut for DebuggerUtility, use $split = true to get many debugs with one debug :)

#### mail($fromEmail,$recipientEmail,$data)

> Get a print_r directly with mail

#### dumpFullTyposcript()

> Debug output the whole TYPOSCRIPT, that is actually defined




## Email

#### send($recipient, $senderEmail, $senderName, $subject, $emailBody)

> Just send an email with one line

#### sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = [])

> Send an email and use a fluid template with assigned variables





## Language

#### getCurrent()

> Get the current language






## Link

Important if you use REALURL: REALURL does not support workspaces. If you are are using a workspace, REALURL will be ignored.

#### getLinkPid($pid, $useCacheHash = true, $forceAbsoluteUrl = true)

> Generate a link with PID

#### getLinkAction($pid, $extension, $controller, $action, $extraParameters = [], $typeNum = false, $useCacheHash = true, $forceAbsoluteUrl = true)

> Generate a link with some more settings