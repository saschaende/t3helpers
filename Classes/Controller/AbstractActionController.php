<?php

namespace SaschaEnde\T3helpers\Controller;

use SaschaEnde\T3helpers\Utilities\BackendUser;
use SaschaEnde\T3helpers\Utilities\Configuration;
use SaschaEnde\T3helpers\Utilities\Data;
use SaschaEnde\T3helpers\Utilities\Database;
use SaschaEnde\T3helpers\Utilities\Debug;
use SaschaEnde\T3helpers\Utilities\Filesystem;
use SaschaEnde\T3helpers\Utilities\FrontendUser;
use SaschaEnde\T3helpers\Utilities\Google;
use SaschaEnde\T3helpers\Utilities\Injections;
use SaschaEnde\T3helpers\Utilities\Language;
use SaschaEnde\T3helpers\Utilities\Mail;
use SaschaEnde\T3helpers\Utilities\Page;
use SaschaEnde\T3helpers\Utilities\Password;
use SaschaEnde\T3helpers\Utilities\Session;
use SaschaEnde\T3helpers\Utilities\Settings;
use SaschaEnde\T3helpers\Utilities\Template;
use SaschaEnde\T3helpers\Utilities\Tsfe;
use SaschaEnde\T3helpers\Utilities\Upload;
use SaschaEnde\T3helpers\Utilities\Uri;

class AbstractActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * @var BackendUser
     * @inject
     */
    protected $BackendUser;

    /**
     * @var FrontendUser
     */
    protected $FrontendUser;

    /**
     * @var Configuration
     * @inject
     */
    protected $Configuration;

    /**
     * @var Data
     * @inject
     */
    protected $Data;

    /**
     * @var Database
     * @inject
     */
    protected $Database;

    /**
     * @var Debug
     * @inject
     */
    protected $Debug;

    /**
     * @var Filesystem
     * @inject
     */
    protected $Filesystem;

    /**
     * @var Google
     * @inject
     */
    protected $Google;

    /**
     * @var Injections
     * @inject
     */
    protected $Injections;

    /**
     * @var Language
     * @inject
     */
    protected $Language;

    /**
     * @var Mail
     * @inject
     */
    protected $Mail;

    /**
     * @var Password
     * @inject
     */
    protected $Password;

    /**
     * @var Session
     * @inject
     */
    protected $Session;

    /**
     * @var Settings
     * @inject
     */
    protected $Settings;

    /**
     * @var Template
     * @inject
     */
    protected $Template;

    /**
     * @var Upload
     * @inject
     */
    protected $Upload;

    /**
     * @var Uri
     * @inject
     */
    protected $Uri;

    /**
     * @var Page
     * @inject
     */
    protected $Page;

    /**
     * @var Tsfe
     * @inject
     */
    protected $Tsfe;

}