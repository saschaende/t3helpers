<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;

/**
 * Class BackendUser
 * Backend Userdata is only available in Backend and on pages where the backend user has permissions. Otherwise this will return null
 * @package SaschaEnde\T3helpers\Utilities
 */
class BackendUser implements BackendUserInterface, SingletonInterface {

    protected $beUser;

    /**
     * Get the user (that is logged in)
     * @return mixed|\TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    public function __construct(){
        $this->beUser = $GLOBALS['BE_USER'];
    }

    /**
     * @return mixed|\TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    public function get(){
        return $this->beUser;
    }

    /**
     * @return array
     */
    public function getGroups(){
        return $this->beUser->userGroups;
    }

    /**
     * @return array
     */
    public function getAllowedPages(){
        $pids = [];
        foreach($GLOBALS['BE_USER']->userGroups as $group){
            if(!empty($group['db_mountpoints'])){
                $pids[] = $group['db_mountpoints'];
            }
        }
        if(!empty($GLOBALS['BE_USER']->user['db_mountpoints'])){
            $pids[] = $GLOBALS['BE_USER']->user['db_mountpoints'];
        }
        return $pids;
    }

    /**
     * @return array
     */
    public function getAllowedPagesUris(){
        $allowedPages = $this->getAllowedPages();
        $pids = [];
        $uriList = [];

        // Hole all IDs von allen Unterseiten
        foreach($allowedPages as $p){
            $pids[] = $p;
            $pt = t3h::Page()->getPagetree($p,999);
            foreach($pt as $id){
                $pids[] = $id;
            }
        }
        $pids = array_unique($pids);

        // Aktuelle Workspace ID zwischenspeichern
        $ws = $GLOBALS['BE_USER']->workspace;
        // Workspace auf standard setzen (RealURL kommt mit Workspaces nicht klar)
        $GLOBALS['BE_USER']->workspace = 0;
        foreach($pids as $id){
            $link = t3h::Link()->getByPid($id, true, false);
            if(!empty($link)){
                $uriList[] = $link;
            }
        }
        // Workspace wieder zurücksetzen
        $GLOBALS['BE_USER']->workspace = $ws;
        // Liste der Uris zurückgeben
        return $uriList;
    }

}