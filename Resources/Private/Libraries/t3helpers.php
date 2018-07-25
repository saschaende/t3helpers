<?php

namespace t3h;

use SaschaEnde\T3helpers\Utilities\BackendUserInterface;
use SaschaEnde\T3helpers\Utilities\CategoryInterface;
use SaschaEnde\T3helpers\Utilities\CommandInterface;
use SaschaEnde\T3helpers\Utilities\ConfigurationInterface;
use SaschaEnde\T3helpers\Utilities\CsvInterface;
use SaschaEnde\T3helpers\Utilities\DatabaseInterface;
use SaschaEnde\T3helpers\Utilities\DataInterface;
use SaschaEnde\T3helpers\Utilities\DatastorageInterface;
use SaschaEnde\T3helpers\Utilities\DebugInterface;
use SaschaEnde\T3helpers\Utilities\FilesystemInterface;
use SaschaEnde\T3helpers\Utilities\FrontendUserInterface;
use SaschaEnde\T3helpers\Utilities\GoogleInterface;
use SaschaEnde\T3helpers\Utilities\Html5PatternsInterface;
use SaschaEnde\T3helpers\Utilities\InjectionsInterface;
use SaschaEnde\T3helpers\Utilities\LanguageInterface;
use SaschaEnde\T3helpers\Utilities\MailInterface;
use SaschaEnde\T3helpers\Utilities\PageInterface;
use SaschaEnde\T3helpers\Utilities\PasswordInterface;
use SaschaEnde\T3helpers\Utilities\SessionInterface;
use SaschaEnde\T3helpers\Utilities\SettingsInterface;
use SaschaEnde\T3helpers\Utilities\TemplateInterface;
use SaschaEnde\T3helpers\Utilities\TsfeInterface;
use SaschaEnde\T3helpers\Utilities\UploadInterface;
use SaschaEnde\T3helpers\Utilities\UriInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class t3h {

    /**
     * @return FilesystemInterface
     */
    public static function Filesystem() {
        return self::injectClass(FilesystemInterface::class);
    }

    /**
     * @return ConfigurationInterface
     */
    public static function Configuration() {
        return self::injectClass(ConfigurationInterface::class);
    }

    /**
     * @return SettingsInterface
     */
    public static function Settings() {
        return self::injectClass(SettingsInterface::class);
    }

    /**
     * @return DataInterface
     */
    public static function Data() {
        return self::injectClass(DataInterface::class);
    }

    /**
     * @return SessionInterface
     */
    public static function Session() {
        return self::injectClass(SessionInterface::class);
    }

    /**
     * @return MailInterface
     */
    public static function Mail() {
        return self::injectClass(MailInterface::class);
    }

    /**
     * @return LanguageInterface
     */
    public static function Language() {
        return self::injectClass(LanguageInterface::class);
    }

    /**
     * @return DatabaseInterface
     */
    public static function Database() {
        return self::injectClass(DatabaseInterface::class);
    }

    /**
     * @return UriInterface
     * @deprecated
     */
    public static function Link() {
        return self::Uri();
    }

    /**
     * @return UriInterface
     */
    public static function Uri() {
        return self::injectClass(UriInterface::class);
    }

    /**
     * @return InjectionsInterface
     */
    public static function Inject() {
        return self::injectClass(InjectionsInterface::class);
    }

    /**
     * @return GoogleInterface
     */
    public static function Google() {
        return self::injectClass(GoogleInterface::class);
    }

    /**
     * @return PasswordInterface
     */
    public static function Password() {
        return self::injectClass(PasswordInterface::class);
    }

    /**
     * @return TemplateInterface
     */
    public static function Template() {
        return self::injectClass(TemplateInterface::class);
    }

    /**
     * @return DebugInterface
     */
    public static function Debug() {
        return self::injectClass(DebugInterface::class);
    }

    /**
     * @return BackendUserInterface
     */
    public static function BackendUser() {
        return self::injectClass(BackendUserInterface::class);
    }

    /**
     * @return PageInterface
     */
    public static function Page() {
        return self::injectClass(PageInterface::class);
    }

    /**
     * @return TsfeInterface
     */
    public static function Tsfe() {
        return self::injectClass(TsfeInterface::class);
    }

    /**
     * @return CategoryInterface
     */
    public static function Category() {
        return self::injectClass(CategoryInterface::class);
    }

    /**
     * @return CommandInterface
     */
    public static function Command() {
        return self::injectClass(CommandInterface::class);
    }

    /**
     * @return FrontendUserInterface
     */
    public static function FrontendUser() {
        return self::injectClass(FrontendUserInterface::class);
    }

    /**
     * @return DatastorageInterface
     */
    public static function Datastorage() {
        return self::injectClass(DatastorageInterface::class);
    }

    /**
     * @return UploadInterface
     */
    public static function Upload(){
        return self::injectClass(UploadInterface::class);
    }

    /**
     * @return CsvInterface
     */
    public static function Csv(){
        return self::injectClass(CsvInterface::class);
    }

    /**
     * @return Html5PatternsInterface
     */
    public static function Html5Patterns(){
        return self::injectClass(Html5PatternsInterface::class);
    }

    // ---------------------------------------------------------------------------------
    // Objectmanager
    // ---------------------------------------------------------------------------------

    public static function injectClass($class) {
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        return $objectManager->get($class);
    }

}