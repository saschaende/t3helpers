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