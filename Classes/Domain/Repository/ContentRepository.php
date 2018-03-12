<?php

namespace SaschaEnde\T3helpers\Domain\Repository;

class ContentRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

    /**
     * Initializes the repository.
     *
     * @return void
     * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
     */
    public function initializeObject() {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
        $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface');
        $querySettings->setRespectStoragePage(FALSE);
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Returns all objects of this repository which matches the given pid. This
     * overwritten method exists, to perform sorting
     *
     * @param integer $pid Pid to search for
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult All found objects, will be
     *         empty if there are no objects
     */
    public function findByPid($pid) {
        $query = $this->createQuery();
        $query->matching(
            $query->equals('pid', $pid)
        );
        $query->setOrderings(array(
            'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
        ));
        return $query->execute();
    }

    /**
     * Returns all objects of this repository which are located inside the
     * given pages
     *
     * @param array<\PwTeaserTeam\PwTeaser\Domain\Model\Page> $pages Pages to get content elements
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult All found objects, will be
     *         empty if there are no objects
     */
    public function findByPages($pages) {
        $query = $this->createQuery();
        $constraint = array();

        foreach ($pages as $page) {
            $constraint[]  = $query->equals('pid', $page->getUid());
        }

        $query->matching(
            $query->logicalOr($constraint)
        );

        return $query->execute();
    }
}