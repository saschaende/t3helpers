# T3Helpers - Helpers for TYPO3

Helpers for Extbase: Simple and easy functions that make your TYPO3 life with extbase and extension development a little easier. Please let me know if you have any ideas or if you find any errors, i will fix this immediately.

* **CMS**: TYPO3
* **Type**: plugin

# Installation

## Composer

* https://packagist.org/packages/saschaende/t3helpers

``composer require saschaende/t3helpers``

# How to use

Type "t3h::" and get a list of all functions. For example:

```
$extension = t3h::Filesystem()->getFileExtension($_FILES['tx_semusicuserarea_musicupload']['name']['mp3'])
 ```   
 
You can find all features in:
t3helpers\Classes\Utilities

Look around in this extension, you will find many helpful tools.

# t3helpers Api Docs


# BackendUser

Class BackendUser
Backend Userdata is only available in Backend and on pages where the backend user has permissions. Otherwise this will return null

## t3h::BackendUser->get()





##### return
* mixed|\TYPO3\CMS\Core\Authentication\BackendUserAuthentication






## t3h::BackendUser->getGroups()





##### return
* array






## t3h::BackendUser->getAllowedPages()





##### return
* array






## t3h::BackendUser->getAllowedPagesUris()





##### return
* array






---

# Category


## t3h::Category->getByString(<span class="label label-danger">$categories</span>, <span class="label label-primary">$delimiter = ","</span>)





##### param
* $categories
* string $delimiter








##### return
* array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface








##### throws
* \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException






## t3h::Category->getCategoriesForFile(<span class="label label-danger">$uid</span>)





##### param
* $uid








##### see
* \SaschaEnde\T3helpers\Utilities\Filesystem::getCategoriesForFile()






---

# Command


## t3h::Command->register(<span class="label label-danger">$class</span>)

Call this in "ext_localconf.php"




##### param
* $class






---

# Configuration

Class Configuration

## t3h::Configuration->setExtension(<span class="label label-danger">$ext</span>)





##### param
* $ext








##### return
* $this






## t3h::Configuration->get(<span class="label label-danger">$propertyName</span>)





##### param
* $propertyName








##### return
* mixed








##### throws
* \TYPO3\CMS\Core\Exception






## t3h::Configuration->getAll()





##### return
* mixed






---

# Csv


## t3h::Csv->setFile(<span class="label label-danger">$file</span>)





##### param
* $file








##### return
* $this






## t3h::Csv->setAutoUTF(<span class="label label-danger">$autoUTF</span>)





##### param
* bool $autoUTF








##### return
* $this






## t3h::Csv->getFileParsed(<span class="label label-primary">$object = false</span>)

Get parsed file




##### param
* bool $object Set true, to return std objects








##### return
* array|bool|null






## t3h::Csv->setFormatting(<span class="label label-primary">$delimiter = ","</span>, <span class="label label-primary">$enclosure = """</span>, <span class="label label-primary">$escape = "\"</span>)





##### param
* string $delimiter
* string $enclosure
* string $escape








##### return
* $this






## t3h::Csv->addRule(<span class="label label-danger">$column</span>, <span class="label label-primary">$regex = "any"</span>, <span class="label label-primary">$option = ""</span>, <span class="label label-primary">$emptyAllowed = false</span>, <span class="label label-primary">$pos = null</span>)





##### param
* $column
* string $regex
* string $option
* bool $emptyAllowed
* null $pos








##### return
* $this|CsvInterface






## t3h::Csv->check()

Check the csv against the rules




##### return
* array






---

# Data


## t3h::Data->sortObjectStorage(<span class="label label-danger">$object</span>, <span class="label label-danger">$function</span>, <span class="label label-primary">$ordering = "asc"</span>)

Example: t3h::Data()->sortObjectStorage($users,'getUsername','asc')




##### param
* ObjectStorage $object
* $function
* string $ordering








##### return
* ObjectStorage






## t3h::Data->sortArray(<span class="label label-danger">$arr</span>, <span class="label label-danger">$fields</span>)





##### param
* $arr
* $fields








##### return
* mixed






## t3h::Data->arrayToObject(<span class="label label-danger">$array</span>)





##### param
* $array








##### return
* \stdClass






## t3h::Data->xmlToArray(<span class="label label-danger">$xmldata</span>)

Create an array from xml string - cause GeneralUtility::xml2array is buggy with some xml structures




##### param
* $xmldata








##### return
* \t3h\DOMDocument






## t3h::Data->arrayToXml(<span class="label label-danger">$data</span>, <span class="label label-primary">$rootNodeName = "data"</span>, <span class="label label-primary">$xml = null</span>)

The main function for converting to an XML document.
Pass in a multi dimensional array and this recrusively loops through and builds up an XML document.




##### param
* array $data
* string $rootNodeName - what you want the root node to be - defaultsto data.
* SimpleXMLElement $xml - should only be used recursively








##### return
* string XML






## t3h::Data->formatRTE(<span class="label label-danger">$str</span>)

Format html code with RTE features




##### param
* $str








##### return
* string






## t3h::Data->autoUTF(<span class="label label-danger">$s</span>)

automatic convertion info utf-8 string




##### param
*   string  $s








##### return
*  string






## t3h::Data->get_youtube_id_from_url(<span class="label label-danger">$url</span>)





##### param
* $url








##### return
* mixed






## t3h::Data->parse_url(<span class="label label-danger">$url</span>)

Extended version of parse_url




##### param
* $url






---

# Database


## t3h::Database->getQuerySettings(<span class="label label-primary">$setRespectStoragePage = false</span>, <span class="label label-primary">$setIgnoreEnableFields = false</span>, <span class="label label-primary">$setIncludeDeleted = false</span>)





##### param
* bool $setRespectStoragePage
* bool $setIgnoreEnableFields
* bool $setIncludeDeleted








##### return
* Typo3QuerySettings






## t3h::Database->truncateTable(<span class="label label-danger">$table</span>)





##### param
* $table






## t3h::Database->getObjectStorageByQueryResult(<span class="label label-danger">$queryResult</span>)





##### param
* $queryResult








##### return
* ObjectStorage






## t3h::Database->getQuerybuilder(<span class="label label-danger">$table</span>, <span class="label label-primary">$addFrom = true</span>)





##### param
* $table
* $addFrom








##### return
* \TYPO3\CMS\Core\Database\Query\QueryBuilder






## t3h::Database->persistAll()

Persist All


---

# Datastorage


## t3h::Datastorage->extension(<span class="label label-danger">$extension</span>)





##### param
* $extension








##### return
* $this






## t3h::Datastorage->set(<span class="label label-danger">$key</span>, <span class="label label-danger">$data</span>)





##### param
* $key
* $data






## t3h::Datastorage->get(<span class="label label-danger">$key</span>, <span class="label label-danger">$data</span>)





##### param
* $key
* $data








##### return
* mixed|bool






## t3h::Datastorage->exists(<span class="label label-danger">$key</span>)





##### param
* $key








##### return
* bool






---

# Debug


## t3h::Debug->dump(<span class="label label-danger">$data</span>, <span class="label label-primary">$split = false</span>)





##### param
* $data
* bool $split






## t3h::Debug->mail(<span class="label label-danger">$fromEmail</span>, <span class="label label-danger">$recipientEmail</span>, <span class="label label-danger">$data</span>)





##### param
* $fromEmail
* $recipientEmail
* $data






## t3h::Debug->dumpFullTyposcript()



## t3h::Debug->query(<span class="label label-danger">$query</span>)





##### todo
* Testen und aufräumen








##### param
* \TYPO3\CMS\Extbase\Persistence\QueryInterface $query






---

# Filesystem


## t3h::Filesystem->fileExists(<span class="label label-danger">$folder</span>, <span class="label label-danger">$fileName</span>)

Check if file exists in a folder




##### param
* $folder
* $fileName








##### return
* bool








##### throws
* \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException






## t3h::Filesystem->getFileByName(<span class="label label-danger">$folder</span>, <span class="label label-danger">$fileName</span>)





##### param
* $folder
* $fileName








##### return
* null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile








##### throws
* \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException






## t3h::Filesystem->deleteFileByName(<span class="label label-danger">$folder</span>, <span class="label label-danger">$fileName</span>)





##### param
* $folder
* $fileName








##### return
* bool|null|\TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\ProcessedFile








##### throws
* \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException






## t3h::Filesystem->getFileByID(<span class="label label-danger">$id</span>)





##### param
* $id








##### return
* array|bool






## t3h::Filesystem->getFileObjectByID(<span class="label label-danger">$id</span>)





##### param
* $id








##### return
* bool|\TYPO3\CMS\Core\Resource\File






## t3h::Filesystem->getFilesByFolder(<span class="label label-danger">$folder</span>)





##### param
* $folder








##### return
* array








##### throws
* \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException






## t3h::Filesystem->getFileObjectsByFolder(<span class="label label-danger">$folder</span>)





##### param
* $folder








##### return
* array








##### throws
* \TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException






## t3h::Filesystem->getFileExtPath(<span class="label label-danger">$extension</span>, <span class="label label-danger">$path</span>)





##### param
* $extension
* $path








##### return
* string






## t3h::Filesystem->getCategoriesForFile(<span class="label label-danger">$uid</span>)





##### param
* $uid








##### return
* array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface






## t3h::Filesystem->setFileReference(<span class="label label-danger">$file</span>, <span class="label label-danger">$uid_foreign</span>, <span class="label label-danger">$pid</span>, <span class="label label-danger">$table</span>, <span class="label label-danger">$fieldname</span>)

Always Use this AFTER adding a new object to the database - because you need the $uid_foreign of this object :)




##### param
* \TYPO3\CMS\Core\Resource\File $file File Object (FAL), the uploaded file
* $uid_foreign UID of the element (for example a content element)
* $pid Page UID of the page, where the item is stored
* $table tha table of the item (for example tt_content)
* $fieldname the field name for the relations (for example "assets")








##### return
* bool true|false






## t3h::Filesystem->getFileExtension(<span class="label label-danger">$filename</span>)

Get the file extension (f.e. mp3, doc, zip...)




##### param
* $filename








##### return
* string






## t3h::Filesystem->getUniqueFilename()



---

# FrontendUser


## t3h::FrontendUser->getCurrentUser()





##### return
* User






## t3h::FrontendUser->getLanguage()

Get language uid of current user




##### return
* int






## t3h::FrontendUser->loginUser(<span class="label label-danger">$username</span>)

Manually login a user




##### param
* $username








##### throws
* \ReflectionException






---

# Google


## t3h::Google->getGeoCoordinates(<span class="label label-danger">$googleApiKey</span>, <span class="label label-danger">$address</span>)





##### param
* $googleApiKey
* $address








##### return
* array|bool






## t3h::Google->getYoutubeVideoIdByUrl(<span class="label label-danger">$url</span>)

Get Youtube video ID from URL




##### param
* string $url








##### return
* mixed Youtube video ID or FALSE if not found






---

# Html5Patterns


## t3h::Html5Patterns->get()



---

# Icons


## t3h::Icons->setExtension(<span class="label label-danger">$ext</span>)





##### param
* string $ext Extension name








##### return
* $this






## t3h::Icons->add(<span class="label label-danger">$icon</span>, <span class="label label-danger">$identifier</span>)

Add icon file




##### param
* string $icon F.e. Extension.png
* string $identifier






---

# Injections


## t3h::Injections->setExtension(<span class="label label-danger">$ext</span>)





##### param
* $ext








##### return
* $this






## t3h::Injections->phpFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->jsFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->jsFooterFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->jsLibraryFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->cssFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->cssLibraryFile(<span class="label label-danger">$filepath</span>)





##### param
* $filepath






## t3h::Injections->addFlexform(<span class="label label-danger">$plugin</span>)

Add flexform




##### param
* $plugin






---

# Language


## t3h::Language->getCurrent()

Get the current language




##### return
* string






---

# Mail


## t3h::Mail->send(<span class="label label-danger">$recipient</span>, <span class="label label-danger">$senderEmail</span>, <span class="label label-danger">$senderName</span>, <span class="label label-danger">$subject</span>, <span class="label label-danger">$emailBody</span>, <span class="label label-primary">$attachments = []</span>, <span class="label label-primary">$priority = false</span>)





##### param
* $recipient
* $senderEmail
* $senderName
* $subject
* $emailBody
* array $attachments
* bool $priority








##### return
* bool|mixed






## t3h::Mail->sendTemplate(<span class="label label-danger">$recipient</span>, <span class="label label-danger">$senderEmail</span>, <span class="label label-danger">$senderName</span>, <span class="label label-danger">$subject</span>, <span class="label label-danger">$extension</span>, <span class="label label-danger">$path</span>, <span class="label label-primary">$variables = []</span>, <span class="label label-primary">$attachments = []</span>, <span class="label label-primary">$priority = false</span>, <span class="label label-primary">$controllerContext = null</span>)





##### param
* $recipient
* $senderEmail
* $senderName
* $subject
* $extension
* $path
* array $variables
* array $attachments
* bool $priority
* null $controllerContext $controllerContext In your controller action use $this->controllerContext, important for using translation








##### return
* bool|mixed






## t3h::Mail->sendDynamicTemplate(<span class="label label-danger">$recipient</span>, <span class="label label-danger">$senderEmail</span>, <span class="label label-danger">$senderName</span>, <span class="label label-danger">$subject</span>, <span class="label label-danger">$extension</span>, <span class="label label-danger">$template</span>, <span class="label label-primary">$variables = []</span>, <span class="label label-primary">$attachments = []</span>, <span class="label label-primary">$priority = false</span>, <span class="label label-primary">$controllerContext = null</span>)

Render a template, it will be called dynamically depending on template, layout and partials paths. This will not work without TYPOSCRIPT settings




##### param
* $recipient
* $senderEmail
* $senderName
* $subject
* $extension
* $template
* array $variables
* array $attachments
* bool $priority
* null $controllerContext








##### return
* bool|mixed






---

# Page


## t3h::Page->getPid()





##### return
* mixed|string






## t3h::Page->getTitle()





##### return
* mixed






## t3h::Page->getPagetree(<span class="label label-danger">$topId</span>, <span class="label label-primary">$depth = 1000000</span>)





##### param
* $topId
* int $depth








##### return
* array






---

# Password

TYPO3 9:
$hashInstance = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Crypto\PasswordHashing\PasswordHashFactory::class)->getDefaultHashInstance('FE');
$user->setPassword($hashInstance->getHashedPassword($user->getPassword()));

## t3h::Password->getHashedPassword(<span class="label label-danger">$password</span>)

Get the hashed password




##### return
* null|string






## t3h::Password->checkPassword(<span class="label label-danger">$plainPW</span>, <span class="label label-danger">$saltedHashPW</span>)

Check password




##### return
* null|string






## t3h::Password->createReadablePassword(<span class="label label-primary">$letters = 8</span>, <span class="label label-primary">$length = false</span>)

Create a human readable password




##### param
* int $letters
* bool $length








##### return
* string






---

# Session


## t3h::Session->setExtension()



## t3h::Session->get()



## t3h::Session->remove()



## t3h::Session->set()



## t3h::Session->exists()



---

# Settings


## t3h::Settings->getExtension(<span class="label label-danger">$extensionName</span>, <span class="label label-primary">$part = "settings"</span>)





##### param
* $extensionName
* string $part








##### return
* mixed






## t3h::Settings->getPlugin()



## t3h::Settings->getFullTyposcript()



## t3h::Settings->getTypo3Configuration(<span class="label label-primary">$part = false</span>)





##### param
* bool $part default: false (BE, DB, EXT, MAIL, FE, SYS...)








##### return
* mixed






---

# Template


## t3h::Template->renderDynamic(<span class="label label-primary">$extension = "tx_myextension"</span>, <span class="label label-primary">$template = "Default"</span>, <span class="label label-primary">$variables = []</span>, <span class="label label-primary">$controllerContext = null</span>)

Render a template, it will be called dynamically depending on template, layout and partials paths. This will not work without TYPOSCRIPT settings.




##### param
* string $extension
* string $template
* array $variables
* null $controllerContext








##### return
* string|void






## t3h::Template->render(<span class="label label-danger">$extension</span>, <span class="label label-danger">$path</span>, <span class="label label-primary">$variables = []</span>, <span class="label label-primary">$controllerContext = null</span>)

Render a template




##### param
* $extension gridelements
* $path Resources/Private/Templates/Mytemplate.html
* array $variables
* null $controllerContext In your controller action use $this->controllerContext, important for using translation








##### return
* string






---

# Tsfe


## t3h::Tsfe->init()



---

# Upload


## t3h::Upload->setAllowedFiletypes(<span class="label label-danger">$filetypes</span>)

Set allowed filetypes




##### param
* $filetypes








##### return
* $this






## t3h::Upload->setMaxFilesize(<span class="label label-danger">$size</span>)

Set max filesize, allowed for each file




##### param
* $size








##### return
* $this






## t3h::Upload->setAutofilenames(<span class="label label-danger">$setting</span>)

Enable autonaming of uploaded files with hash values




##### param
* $setting








##### return
* $this






## t3h::Upload->check()

Check uploaded files and set them for upload




##### return
* array






## t3h::Upload->getFiles()

Get the list of files that will be uploaded




##### return
* array






## t3h::Upload->execute(<span class="label label-primary">$target_folder = false</span>)

Upload files to target directory




##### param
* $target_folder






---

# Uri

Class Uri

## t3h::Uri->getByPid()



## t3h::Uri->getByAction(<span class="label label-danger">$pid</span>, <span class="label label-danger">$extension</span>, <span class="label label-danger">$controller</span>, <span class="label label-danger">$action</span>, <span class="label label-primary">$arguments = []</span>, <span class="label label-primary">$typeNum = false</span>, <span class="label label-primary">$useCacheHash = true</span>, <span class="label label-primary">$forceAbsoluteUrl = true</span>, <span class="label label-primary">$additionalParameters = []</span>)





##### param
* $pid
* $extension
* $controller
* $action
* array $arguments
* bool $typeNum
* bool $useCacheHash
* bool $forceAbsoluteUrl
* array $additionalParameters








##### return
* string






---

# Website


## t3h::Website->getWebsiteRootPid()

Frontend: Get current Website Root PID




##### return
* mixed






---


