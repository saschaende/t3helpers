<?php
/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Sascha Ende <s.ende@pixelcreation.de>, pixelcreation GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace SaschaEnde\T3helpers\Domain\Model;

use \TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Pages extends AbstractEntity {

    /**
     * @var int
     */
    protected $uid;

    /**
     * @var int
     * @lazy
     */
    protected $pid;

    /**
     * The blog post creation date.
     *
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var bool
     */
    protected $hidden;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * @var int
     */
    protected $doktype;

    protected $t3verOid;
    protected $t3verId;
    protected $t3verWsid;

    /**
     * @var boolean
     */
    protected $modified = false;

    /**
     * @return int
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid($uid) {
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getPid() {
        return $this->pid;
    }

    /**
     * @var int $pid
     */
    public function setPid($pid) {
        $this->pid = $pid;
    }

    /**
     * @return int
     */
    public function getSorting() {
        return $this->sorting;
    }

    /**
     * @param int $sorting
     */
    public function setSorting($sorting) {
        $this->sorting = $sorting;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @return bool
     */
    public function isHidden() {
        return $this->hidden;
    }

    /**
     * @param bool $hidden
     */
    public function setHidden($hidden) {
        $this->hidden = $hidden;
    }

    /**
     * Set categories
     * @param ObjectStorage|Category
     */
    public function setCategories(ObjectStorage $categories) {
        $this->categories = $categories;
    }

    /**
     * Get categories
     * @return ObjectStorage|Category
     */
    public function getCategories() {
        return $this->categories;
    }

    /**
     * @return int
     */
    public function getDoktype() {
        return $this->doktype;
    }

    /**
     * @param int $doktype
     */
    public function setDoktype($doktype) {
        $this->doktype = $doktype;
    }

    /**
     * @return int
     */
    public function getContentCreationDate() {
        return $this->contentCreationDate;
    }

    /**
     * @param int $contentCreationDate
     */
    public function setContentCreationDate($contentCreationDate) {
        $this->contentCreationDate = $contentCreationDate;
    }

    /**
     * @return int
     */
    public function getContentEndDate() {
        return $this->contentEndDate;
    }

    /**
     * @param int $contentEndDate
     */
    public function setContentEndDate($contentEndDate) {
        $this->contentEndDate = $contentEndDate;
    }

    /**
     * @return string
     */
    public function getContentLocation() {
        return $this->contentLocation;
    }

    /**
     * @param string $contentLocation
     */
    public function setContentLocation($contentLocation) {
        $this->contentLocation = $contentLocation;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate() {
        return $this->crdate;
    }

    /**
     * @param \DateTime $crdate
     */
    public function setCrdate($crdate) {
        $this->crdate = $crdate;
    }

    /**
     * @return mixed
     */
    public function getT3verOid() {
        return $this->t3verOid;
    }

    /**
     * @param mixed $t3verOid
     */
    public function setT3verOid($t3verOid) {
        $this->t3verOid = $t3verOid;
    }

    /**
     * @return mixed
     */
    public function getT3verId() {
        return $this->t3verId;
    }

    /**
     * @param mixed $t3verId
     */
    public function setT3verId($t3verId) {
        $this->t3verId = $t3verId;
    }

    /**
     * @return mixed
     */
    public function getT3verWsid() {
        return $this->t3verWsid;
    }

    /**
     * @param mixed $t3verWsid
     */
    public function setT3verWsid($t3verWsid) {
        $this->t3verWsid = $t3verWsid;
    }

    /**
     * @return bool
     */
    public function isModified() {
        return $this->modified;
    }

    /**
     * @param bool $modified
     */
    public function setModified($modified) {
        $this->modified = $modified;
    }

    /**
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor($author) {
        $this->author = $author;
    }

}