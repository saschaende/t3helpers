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

class Contents extends AbstractEntity {

    /**
     * @var int
     */
    protected $uid;

    /**
     * @var int
     */
    protected $pid;

    /**
     * @var int
     */
    protected $sorting;

    /**
     * @var string
     */
    protected $header;

    /**
     * @var string
     */
    protected $bodytext;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $image;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $assets;

    /**
     * sysLanguageUid
     * @var int
     */
    protected $sysLanguageUid;
    /**
     * l18nParent
     * @var int
     */
    protected $l18nParent;


    /**
     * Set uid
     * @param int
     * @return ContentElement
     */
    public function setUid($uid) {
        $this->uid = (int) $uid;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getUid() {
        return $this->uid;
    }

    /**
     * Set pid
     * @param int
     * @return ContentElement
     */
    public function setPid($pid) {
        $this->pid = (int) $pid;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPid() {
        return $this->pid;
    }

    /**
     * Set sorting
     * @param int
     * @return ContentElement
     */
    public function setSorting($sorting) {
        $this->sorting = (int) $sorting;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSorting() {
        return $this->sorting;
    }

    /**
     * Set header
     * @param string
     * @return ContentElement
     */
    public function setHeader($header) {
        $this->header = $header;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * Set bodytext
     * @param string
     * @return ContentElement
     */
    public function setBodytext($bodytext) {
        $this->bodytext = $bodytext;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBodytext() {
        return $this->bodytext;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function setImage(ObjectStorage $images) {
        $this->image = $images;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function setAssets(ObjectStorage $assets) {
        $this->assets = $assets;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    public function getAssets() {
        return $this->assets;
    }

    /**
     * @return int
     */
    public function getSysLanguageUid() {
        return $this->sysLanguageUid;
    }

    /**
     * @param int $sysLanguageUid
     */
    public function setSysLanguageUid($sysLanguageUid) {
        $this->sysLanguageUid = $sysLanguageUid;
    }

    /**
     * @return int
     */
    public function getL18nParent() {
        return $this->l18nParent;
    }

    /**
     * @param int $l18nParent
     */
    public function setL18nParent($l18nParent) {
        $this->l18nParent = $l18nParent;
    }




}
