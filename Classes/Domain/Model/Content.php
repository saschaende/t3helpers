<?php

namespace SaschaEnde\T3helpers\Domain\Model;

class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * ctype
     * @var string
     */
    protected $ctype;

    /**
     * colPos
     * @var integer
     */
    protected $colPos;

    /**
     * header
     * @var string
     */
    protected $header;

    /**
     * bodytext
     * @var string
     */
    protected $bodytext;

    /**
     * image
     * It may contain multiple images, but TYPO3 called this field just "image"
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $image;

    /**
     * Categories
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * Complete row (from database) of this content element
     * @var array
     */
    protected $_contentRow = NULL;

    /**
     * Constructor
     */
    public function __construct() {
        $this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Setter for image(s)
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $image) {
        $this->image = $image;
    }

    /**
     * Getter for images
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage images
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
        $this->image->attach($image);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
        $this->image->detach($image);
    }

    /**
     * Returns image files as array (with all attributes)
     *
     * @return array
     */
    public function getImageFiles() {
        $imageFiles = array();
        /** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $image */
        foreach ($this->getImage() as $image) {
            $imageFiles[] = $image->getOriginalResource()->toArray();
        }
        return $imageFiles;
    }

    /**
     * Setter for bodytext
     *
     * @param string $bodytext bodytext
     * @return void
     */
    public function setBodytext($bodytext) {
        $this->bodytext = $bodytext;
    }

    /**
     * Getter for bodytext
     *
     * @return string bodytext
     */
    public function getBodytext() {
        return $this->bodytext;
    }

    /**
     * Setter for ctype
     *
     * @param string $ctype ctype
     * @return void
     */
    public function setCtype($ctype) {
        $this->ctype = $ctype;
    }

    /**
     * Getter for ctype
     *
     * @return string ctype
     */
    public function getCtype() {
        return $this->ctype;
    }

    /**
     * Setter for colPos
     *
     * @param integer $colPos colPos
     * @return void
     */
    public function setColPos($colPos) {
        $this->colPos = $colPos;
    }

    /**
     * Getter for colPos
     *
     * @return integer colPos
     */
    public function getColPos() {
        return $this->colPos;
    }

    /**
     * Setter for header
     *
     * @param string $header header
     * @return void
     */
    public function setHeader($header) {
        $this->header = $header;
    }

    /**
     * Getter for header
     *
     * @return string header
     */
    public function getHeader() {
        return $this->header;
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
     * Checks for attribute in _contentRow
     *
     * @param string $name Name of unknown method
     * @param array arguments Arguments of call
     *
     * @return mixed
     */
    public function __call($name, $arguments) {
        if (substr(strtolower($name), 0, 3) == 'get' && strlen($name) > 3) {
            $attributeName = lcfirst(substr($name, 3));

            if (empty($this->_contentRow)) {
                /** @var \TYPO3\CMS\Frontend\Page\PageRepository $pageSelect */
                $pageSelect = $GLOBALS['TSFE']->sys_page;
                $contentRow = $pageSelect->getRawRecord('tt_content', $this->getUid());
                foreach ($contentRow as $key => $value) {
                    $this->_contentRow[\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToLowerCamelCase($key)] = $value;
                }
            }
            if (isset($this->_contentRow[$attributeName])) {
                return $this->_contentRow[$attributeName];
            }
        }
    }

    /**
     * @return array
     */
    public function getContentRow() {
        return $this->_contentRow;
    }
}
?>