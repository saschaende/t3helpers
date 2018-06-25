<?php

namespace SaschaEnde\T3helpers\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class AbstractDatamapper
 *
 * Beispiele:
 *
 * updateAction()
 * beforeUpdateAction()
 * newAction()
 * beforeNewAction()
 *
 *
 * Mit Spaltennamen:
 *
 * updateStreetAction($value)
 * beforeUpdateStreetAction($value)
 *
 * Use in your extension with:
 * $GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass']['your_extension'] = \YourName\YourExtension\Hooks\YourDatamapper::class;
 *
 */

class AbstractDatamapper {

    protected $tableToProcess;
    protected $triggerFields = [];
    protected $modifiedFields;
    protected $action;
    protected $table;
    protected $uid;
    protected $pObj;
    protected $objectManager;

    public function __construct() {
        $this->objectManager = $this->getObjectManager();
        if(method_exists($this,'initializeAction')){
            $this->initializeAction();
        }
    }

    /**
     * Hook to add latitude and longitude to locations.
     *
     * @param string $action The action to perform, e.g. 'update'.
     * @param string $table The table affected by action, e.g. 'fe_users'.
     * @param int $uid The uid of the record affected by action.
     * @param array $modifiedFields The modified fields of the record.
     *
     * @return void
     */
    public function processDatamap_postProcessFieldArray( // @codingStandardsIgnoreLine
        $action, $table, $uid, array &$modifiedFields, &$pObj
    ) {
        $this->modifiedFields = &$modifiedFields;
        $this->action = $action;
        $this->table = $table;
        $this->pObj = &$pObj;

        // Main hooks
        $m = 'before' . ucfirst($action) . 'Action';
        if (method_exists($this, $m) && $this->processHook($table, $action, $modifiedFields)) {
            $this->$m();
        }

        // Trigger field related events
        foreach ($this->triggerFields as $fieldname) {
            $m = 'before' . ucfirst($action) . ucfirst($fieldname) . 'Action';
            if (isset($modifiedFields[$fieldname]) && method_exists($this, $m)) {
                $this->$m($modifiedFields[$fieldname]);
            }
        }
    }

    /**
     * Hook to add latitude and longitude to locations.
     *
     * @param string $action The action to perform, e.g. 'update'.
     * @param string $table The table affected by action, e.g. 'fe_users'.
     * @param int $uid The uid of the record affected by action.
     * @param array $modifiedFields The modified fields of the record.
     *
     * @return void
     */
    public function processDatamap_afterDatabaseOperations( // @codingStandardsIgnoreLine
        $action, $table, $uid, array &$modifiedFields, &$pObj
    ) {
        $this->modifiedFields = &$modifiedFields;
        $this->action = $action;
        $this->table = $table;
        $this->pObj = &$pObj;

        if ($action == 'new') {
            $this->uid = $this->pObj->substNEWwithIDs[$uid];
        } else {
            $this->uid = $uid;
        }

        // Main hooks
        $m = $action . 'Action';
        if (method_exists($this, $m) && $this->processHook($table, $action, $modifiedFields)) {
            $this->$m();
        }

        // Trigger Field releated events
        foreach ($this->triggerFields as $fieldname) {
            $m = $action . ucfirst($fieldname) . 'Action';
            if (isset($modifiedFields[$fieldname]) && method_exists($this, $m)) {
                $this->$m($modifiedFields[$fieldname]);
            }
        }
    }

    protected function getUid() {
        return $this->uid;
    }

    protected function getModifiedFields() {
        return $this->modifiedFields;
    }

    /**
     * Check whether to fetch geo information or not.
     *
     * NOTE: Currently allwayd for fe_users, doesn't check the type at the moment.
     *
     * @param string $table
     * @param string $action
     * @param array $modifiedFields
     *
     * @return bool
     */
    private function processHook($table, $action, array $modifiedFields) {
        // Do not process if foreign table, unintended action,
        // or fields were changed explicitly.
        if ($table !== $this->tableToProcess) {
            return false;
        }

        // trigger events in general
        if (count($this->triggerFields) >= 1) {
            foreach ($this->triggerFields as $fieldname) {
                if (isset($modifiedFields[$fieldname])) {
                    return true;
                }
            }
        } else {
            return true;
        }

        return false;
    }

    /**
     * Erhalte ein Repository
     * @return ObjectManager
     */
    private function getObjectManager() {
        return GeneralUtility::makeInstance(ObjectManager::class);
    }

    /**
     * Persistiere alle Daten
     */
    protected function save() {
        GeneralUtility::makeInstance(PersistenceManager::class)->persistAll();
    }

}