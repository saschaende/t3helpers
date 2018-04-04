<?php

namespace SaschaEnde\T3helpers\Domain\Repository;

use t3h\t3h;
use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class PagesRepository extends Repository {

    private $pageIds = [];
    private $categories = [];
    private $categoriesMode = null;
    private $dateStart = null;
    private $dateEnd = null;
    private $authors = [];
    private $sorting = [];
    private $offset = 0;
    private $limit = null;

    public function setPage($pid){
        if(!is_array($pid)){
            $pid = explode(',',$pid);
        }
        $this->pageIds = array_merge($this->pageIds,$pid);
    }

    public function setPageTree($pid) {
        if(!is_array($pid)){
           $pid = explode(',',$pid);
        }
        foreach ($pid as $p){
            $tree = t3h::Page()->getPagetree($p,1000000,1);
            $this->pageIds = array_merge($this->pageIds,$tree);
        }
    }

    public function setCategories($categories,$mode = 'AND') {
        if(!is_array($categories)){
            $categories = explode(",", $categories);
        }
        $this->categories = $categories;
        $this->categoriesMode = $mode;
    }

    public function setDateStart($date){
        $this->dateStart = $date;
    }

    public function setDateEnd($date){
        $this->dateEnd = $date;
    }

    public function setAuthor(){

    }

    public function setSorting($field, $order = 'asc'){
        if ($order == 'ASC') {
            $ordering = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING;
        } else {
            $ordering = \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING;
        }

        $this->sorting = [
            $field => $ordering
        ];
    }

    public function setOffset($offset){
        $this->offset = intval($offset);
    }

    public function setLimit($limit){
        $this->limit = intval($limit);
    }

    public function getResults(){
        $query = $this->createQuery();
        $query->setQuerySettings(t3h::Database()->getQuerySettings(false));

        $constraints = [];

        // Im Menü ausgbelendete Items nicht anzeigen
        $constraints[] = $query->equals('nav_hide',0);

        // Auf SeitenIDs eingrenzen
        if (count($this->pageIds) > 0) {

            $constraints[] = $query->in('uid', $this->pageIds);
        }

        // Kategorien
        if (!empty($this->categories)) {
            $catConstraints = [];
            foreach ($this->categories as $category) {
                if(!empty($category)){
                    $catConstraints[] = $query->equals('categories.uid', $category);
                }
            }

            if(count($catConstraints) >= 1){
                $logicalMethod = 'logical' . ucfirst(strtolower($this->categoriesMode));
                $constraints[] = $query->$logicalMethod($catConstraints);
            }

        }

        // Autoren
        if (!empty($this->authors)) {
            $authorConstraints = [];
            foreach ($this->authors as $author) {
                $authorConstraints[] = $query->equals('author', $author);
            }
            $constraints[] = $query->logicalOr($authorConstraints);
        }

        // Datumsangaben
        if (!empty($this->dateStart)) {
            $str_date_start = strtotime('00:00 ' . date('d-m-Y', $this->dateStart));
            $constraints[] = $query->greaterThan('crdate', $str_date_start);
        }
        if (!empty($this->dateEnd)) {
            $str_date_end = strtotime('23:59 ' . date('d-m-Y', $this->dateEnd));
            $constraints[] = $query->lessThan('crdate', $str_date_end);
        }

        // Sortierung
        $query->setOrderings($this->sorting);

        // Offset
        if($this->offset >= 1){
            $query->setOffset($this->offset);
        }

        // Limit
        if($this->limit >= 1){
            $query->setLimit($this->limit);
        }

        if(count($constraints) >= 1){
            $query->matching($query->logicalAnd($constraints));
        }





        // Rückgabe
        return $query->execute();
    }

}