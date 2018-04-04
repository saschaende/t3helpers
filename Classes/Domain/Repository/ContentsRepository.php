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

namespace SaschaEnde\T3helpers\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;

class ContentsRepository extends Repository {

    private $ignoreEnableFields = true;

    /**
     * Debugs a SQL query from a QueryResult
     */
    public function debugQuery($query) {
        /** @var Typo3DbQueryParser $queryParser */
        $queryParser = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
    }

    public function findByUid($uid){
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->getQuerySettings()->setRespectSysLanguage(true);
        $query->getQuerySettings()->setIgnoreEnableFields($this->ignoreEnableFields);

        $constraints = array();

        $constraints[] = $query->equals('uid', intval($uid));

        $query->matching($query->logicalAnd($constraints));
        return $query->execute();
    }

    /**
     * Find entities with given pid and colPos
     *
     * @param int $pid
     * @param int $colPos
     */
    public function findByPageAndColPos($pid, $colPos = false) {

        /** @var \TYPO3\CMS\Extbase\Persistence\QueryInterface $query */
        $query = $this->createQuery();

        $tableName = 'tt_content';
        if (TYPO3_MODE === 'FE') {
            // Use enableFields in frontend mode
            $enableFields = $GLOBALS['TSFE']->sys_page->enableFields($tableName);
        } else {
            // Use enableFields in backend mode
            $enableFields = \TYPO3\CMS\Backend\Utility\BackendUtility::deleteClause($tableName);
            $enableFields .= \TYPO3\CMS\Backend\Utility\BackendUtility::BEenableFields($tableName);
        }


        // Extbase wants the colPos to be col_pos in database table. Therefore a plain sql-statement is needed.
        if($colPos){
            $query->statement("SELECT * FROM tt_content WHERE pid = " . $pid . " AND colPos = " . $colPos . ' '. $enableFields);
        }else{
            $query->statement("SELECT * FROM tt_content WHERE pid = " . $pid . " ". $enableFields);
        }


        return $query->execute();
    }
}
