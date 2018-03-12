<?php

namespace SaschaEnde\T3helpers\Domain\Model;

class Page extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
    /** Translation constant: Show page always */
    const L18N_SHOW_ALWAYS = 0;
    /** Translation constant: Hide page on default language */
    const L18N_HIDE_DEFAULT_LANGUAGE = 1;
    /** Translation constant: Hide page on foreign language if no translation exists */
    const L18N_HIDE_IF_NO_TRANSLATION_EXISTS = 2;
    /** Translation constant: Hide page always, but show on foreign langauge if translation exists */
    const L18N_HIDE_ALWAYS_BUT_TRANSLATION_EXISTS = 3;


    /**
     * doktype
     * @var integer
     */
    protected $doktype;

    /**
     * isCurrentPage
     * @var boolean
     */
    protected $isCurrentPage = FALSE;

    /**
     * title
     * @var string
     * @validate NotEmpty
     */
    protected $title;

    /**
     * subtitle
     * @var string
     */
    protected $subtitle;

    /**
     * navTitle
     * @var string
     */
    protected $navTitle;

    /**
     * meta keywords
     * @var string
     */
    protected $keywords;

    /**
     * meta description
     * @var string
     */
    protected $description;

    /**
     * abstract
     * @var string
     */
    protected $abstract;

    /**
     * alias
     * @var string
     */
    protected $alias;

    /**
     * media
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $media;

    /**
     * sorting
     * @var integer
     */
    protected $sorting;

    /**
     * creation date
     * @var integer
     */
    protected $creationDate;

    /**
     * timestamp
     * @var integer
     */
    protected $tstamp;

    /**
     * lastUpdated
     * @var integer
     */
    protected $lastUpdated;

    /**
     * start time
     * @var integer
     */
    protected $starttime;

    /**
     * end time
     * @var integer
     */
    protected $endtime;

    /**
     * new until
     * @var integer
     */
    protected $newUntil;

    /**
     * author
     * @var string
     */
    protected $author;

    /**
     * author email
     * @var string
     */
    protected $authorEmail;

    /**
     * contents
     * @var array<\PwTeaserTeam\PwTeaser\Domain\Model\Content>
     */
    protected $contents;

    /**
     * Categories
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * @var integer
     */
    protected $l18nConfiguration;

    /**
     * Child pages
     * @var array<Page>
     */
    protected $childPages = array();

    /**
     * Custom Attributes
     * which can be set by hooks
     *
     * @var array<mixed>
     */
    protected $_customAttributes = array();

    /**
     * Complete row (from database) of this page
     * @var array
     */
    protected $_pageRow = NULL;

    /**
     * @var \TYPO3\CMS\Core\Resource\FileRepository
     * @inject
     */
    protected $fileRepository;

    /**
     * Sets a custom attribute
     *
     * @param string $key The name of the attribute
     * @param mixed $value Attribute's value
     *
     * @return void
     */
    public function setCustomAttribute($key, $value) {
        $this->_customAttributes[$key] = $value;
    }

    /**
     * Returns the value of a custom attribute
     *
     * @param string $key Name of attribute
     * @return mixed The value of a custom attribute
     */
    public function getCustomAttribute($key) {
        if (!empty($key) && $this->hasCustomAttribute($key)) {
            return $this->_customAttributes[$key];
        }
        return NULL;
    }

    /**
     * Checks if given custom attribute has been set
     *
     * @param string $key
     * @return bool
     */
    public function hasCustomAttribute($key) {
        return isset($this->_customAttributes[$key]);
    }

    /**
     * Checks for attribute in _customAttributes and _pageRow
     *
     * @param string $name Name of unknown method
     * @param array arguments Arguments of call
     *
     * @return mixed
     */
    public function __call($name, $arguments) {
        if (substr(strtolower($name), 0, 3) == 'get' && strlen($name) > 3) {
            $attributeName = lcfirst(substr($name, 3));
            if ($this->hasCustomAttribute($attributeName)) {
                return $this->getCustomAttribute($attributeName);
            }

            if (empty($this->_pageRow)) {
                /** @var \TYPO3\CMS\Frontend\Page\PageRepository $pageSelect */
                $pageSelect = $GLOBALS['TSFE']->sys_page;
                $pageRow = $pageSelect->getPage($this->getUid());
                foreach ($pageRow as $key => $value) {
                    $this->_pageRow[\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToLowerCamelCase($key)] = $value;
                }
            }
            if (isset($this->_pageRow[$attributeName])) {
                return $this->_pageRow[$attributeName];
            }
        }
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Setter for contents
     *
     * @param array<\PwTeaserTeam\PwTeaser\Domain\Model\Content> $contents array of contents
     * @return void
     */
    public function setContents($contents) {
        $this->contents = $contents;
    }

    /**
     * Getter for contents
     *
     * @returns array<\PwTeaserTeam\PwTeaser\Domain\Model\Content> contents
     */
    public function getContents() {
        return $this->contents;
    }

    /**
     * Getter for isCurrentPage
     *
     * @return boolean
     */
    public function getIsCurrentPage() {
        return $this->isCurrentPage;
    }

    /**
     * Setter for isCurrentPage
     *
     * @param boolean $isCurrentPage
     * @return void
     */
    public function setIsCurrentPage($isCurrentPage) {
        $this->isCurrentPage = $isCurrentPage;
    }

    /**
     * Setter for authorEmail
     *
     * @param string $authorEmail authorEmail
     * @return void
     */
    public function setAuthorEmail($authorEmail) {
        $this->authorEmail = $authorEmail;
    }

    /**
     * Getter for authorEmail
     *
     * @return string authorEmail
     */
    public function getAuthorEmail() {
        return $this->authorEmail;
    }

    /**
     * Setter for keywords
     *
     * @param string $keywords keywords
     * @return void
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    /**
     * Getter for keywords
     *
     * @return array array of keywords
     */
    public function getKeywords() {
        return(\TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->keywords, TRUE));
    }

    /**
     * Getter for keywords. Returns a string
     *
     * @return string keywords as string
     */
    public function getKeywordsAsString() {
        return $this->keywords;
    }


    /**
     * Setter for description
     *
     * @param string $description description
     * @return void
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Getter for description
     *
     * @return string description
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Setter for alias
     *
     * @param string $alias alias
     * @return void
     */
    public function setAlias($alias) {
        $this->alias = $alias;
    }

    /**
     * Getter for alias
     *
     * @return string alias
     */
    public function getAlias() {
        return $this->alias;
    }

    /**
     * Setter for navTitle
     *
     * @param string $navTitle navTitle
     * @return void
     */
    public function setNavTitle($navTitle) {
        $this->navTitle = $navTitle;
    }

    /**
     * Getter for navTitle
     *
     * @return string navTitle
     */
    public function getNavTitle() {
        return $this->navTitle;
    }

    /**
     * Setter for abstract
     *
     * @param string $abstract abstract
     * @return void
     */
    public function setAbstract($abstract) {
        $this->abstract = $abstract;
    }

    /**
     * Getter for abstract
     *
     * @return string abstract
     */
    public function getAbstract() {
        return $this->abstract;
    }

    /**
     * Setter for subtitle
     *
     * @param string $subtitle subtitle
     * @return void
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    /**
     * Getter for subtitle
     *
     * @return string subtitle
     */
    public function getSubtitle() {
        return $this->subtitle;
    }

    /**
     * Setter for title
     *
     * @param string $title title
     * @return void
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Getter for title
     *
     * @return string title
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Setter for media
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
     * @return void
     */
    public function setMedia(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $media) {
        $this->media = $media;
    }

    /**
     * Getter for media (returns FileReference objects)
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getMedia() {
        return $this->media;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium
     * @return void
     */
    public function addMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $medium) {
        $this->media->attach($medium);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium
     * @return void
     */
    public function removeMedium(\TYPO3\CMS\Extbase\Domain\Model\FileReference $medium) {
        $this->media->detach($medium);
    }

    /**
     * Returns media files as array (with all attributes)
     *
     * @return array
     */
    public function getMediaFiles() {
        $mediaFiles = array();
        /** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $medium */
        foreach ($this->getMedia() as $medium) {
            $mediaFiles[] = $medium->getOriginalResource()->toArray();
        }
        return $mediaFiles;
    }

    /**
     * Setter for newUntil
     *
     * @param integer $newUntil newUntil
     * @return void
     */
    public function setNewUntil($newUntil) {
        $this->newUntil = $newUntil;
    }

    /**
     * Getter for newUntil
     *
     * @return integer newUntil
     */
    public function getNewUntil() {
        return $this->newUntil;
    }

    /**
     * Return TRUE if the page is marked as new
     *
     * @return boolean TRUE if the page is marked as new, otherwise FALSE
     */
    public function getIsNew() {
        if (!empty($this->newUntil) && $this->newUntil !== 0) {
            return $this->newUntil < time();
        }
        return FALSE;
    }

    /**
     * Setter for creationDate
     *
     * @param integer $creationDate creationDate
     * @return void
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    /**
     * Getter for creationDate
     *
     * @return integer creationDate
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * Setter for tstamp
     *
     * @param integer $tstamp tstamp
     * @return void
     */
    public function setTstamp($tstamp) {
        $this->tstamp = $tstamp;
    }

    /**
     * Getter for tstamp
     *
     * @return integer tstamp
     */
    public function getTstamp() {
        return $this->tstamp;
    }

    /**
     * Setter for lastUpdated
     *
     * @param integer $lastUpdated lastUpdated
     * @return void
     */
    public function setLastUpdated($lastUpdated) {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * Getter for lastUpdated
     *
     * @return integer lastUpdated
     */
    public function getLastUpdated() {
        return $this->lastUpdated;
    }

    /**
     * Setter for starttime
     *
     * @param integer $starttime
     * @return void
     */
    public function setStarttime($starttime) {
        $this->starttime = $starttime;
    }

    /**
     * Getter for starttime
     *
     * @return integer starttime
     */
    public function getStarttime() {
        return $this->starttime;
    }

    /**
     * Getter for endtime
     *
     * @return integer endtime
     */
    public function getEndtime() {
        return $this->endtime;
    }

    /**
     * Setter for endtime
     *
     * @param integer $endtime endtime
     * @return void
     */
    public function setEndtime($endtime) {
        $this->endtime = $endtime;
    }

    /**
     * Getter for author
     *
     * @return string author
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Setter for author
     *
     * @param string $author author
     * @return void
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

    /**
     * Getter for doktype
     *
     * @return integer the doktype
     */
    public function getDoktype() {
        return $this->doktype;
    }

    /**
     * Setter for doktype
     *
     * @param integer $doktype the doktype
     * @return void
     */
    public function setDoktype($doktype) {
        $this->doktype = $doktype;
    }

    /**
     * Getter for l18nConfiguration
     *
     * @return integer
     */
    public function getL18nConfiguration() {
        return $this->l18nConfiguration;
    }

    /**
     * Setter for l18nConfiguration
     *
     * @param integer $l18nCfg
     * @return void
     */
    public function setL18nConfiguration($l18nCfg) {
        $this->l18nConfiguration = $l18nCfg;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories
     * @return void
     */
    public function setCategories($categories) {
        $this->categories = $categories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     * @return void
     */
    public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
        $this->categories->attach($category);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     * @return void
     */
    public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
        $this->categories->detach($category);
    }

    /**
     * Returns rootLine of this page
     *
     * @return array
     */
    public function getRootLine() {
        /** @var \TYPO3\CMS\Frontend\Page\PageRepository $pageSelect */
        $pageSelect = $GLOBALS['TSFE']->sys_page;
        return $pageSelect->getRootLine($this->getUid());
    }

    /**
     * Returns amount of parent pages, including this page itself.
     * The root page (not id=0) got depth 1.
     *
     * @return integer
     */
    public function getRootLineDepth() {
        return count($this->getRootLine());
    }

    /**
     * Returns string of sortings of all root pages including this page.
     *
     * @return string String with orderings of this page and all root pages
     */
    public function getRecursiveRootLineOrdering() {
        $recursiveOrdering = array();
        foreach ($this->getRootLine() as $pageRootPart) {
            array_unshift($recursiveOrdering, str_pad($pageRootPart['sorting'], 11, '0', STR_PAD_LEFT));
        }
        return implode('-', $recursiveOrdering);
    }

    /**
     * Returns the complete page row (from database) as array
     * @return array
     */
    public function getPageRow() {
        return $this->_pageRow;
    }

    /**
     * @return integer
     */
    public function getSorting() {
        return $this->sorting;
    }

    /**
     * @param integer $sorting
     * @return void
     */
    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }

    /**
     * @return array
     */
    public function getChildPages() {
        return $this->childPages;
    }

    /**
     * @param array<Page> $childPages
     * @return void
     */
    public function setChildPages(array $childPages) {
        $this->childPages = $childPages;
    }
}
?>