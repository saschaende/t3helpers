<?php

namespace SaschaEnde\T3helpers\Helpers;

class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder {

    /**
     * Uid of the referenced sys_file. Needed for extbase to serialize the
     * reference correctly.
     *
     * @var int
     */
    protected $uidLocal;

    /**
     * @var string
     */
    protected $tablenames = 'tx_extension_domain_model_table';

    /**
     * @var string
     */
    protected $tableLocal = 'sys_file';

    /**
     * @param \TYPO3\CMS\Core\Resource\ResourceInterface $originalResource
     */
    public function setOriginalResource(\TYPO3\CMS\Core\Resource\ResourceInterface $originalResource) {
        $this->originalResource = $originalResource;
        $this->uidLocal         = (int)$originalResource->getUid();
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\FileReference
     */
    public function getOriginalResource() {
        if($this->originalResource === NULL) {
            $this->originalResource = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance()->getFileReferenceObject(
                $this->getUid()
            );
        }

        return $this->originalResource;
    }

    /**
     * @return string
     */
    public function getTablenames() {
        return $this->tablenames;
    }

    /**
     * @param string $tablenames
     */
    public function setTablenames($tablenames) {
        $this->tablenames = $tablenames;
    }

    /**
     * setFile
     *
     * @param \TYPO3\CMS\Core\Resource\File $falFile
     * @return void
     */
    public function setFile(\TYPO3\CMS\Core\Resource\File $falFile) {
        $this->originalFileIdentifier = (int)$falFile->getUid();
    }
}