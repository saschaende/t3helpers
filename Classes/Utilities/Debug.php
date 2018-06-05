<?php

namespace SaschaEnde\T3helpers\Utilities;


use t3h\t3h;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Debug implements DebugInterface, SingletonInterface {

    /**
     * @param $data
     * @param bool $split
     */
    public function dump($data,$split = false) {
        if($split && (is_array($$data) || is_object($data))){
            foreach($data as $col){
                DebuggerUtility::var_dump($col);
            }
        }else{
            DebuggerUtility::var_dump($data);
        }

    }

    /**
     * @param $fromEmail
     * @param $recipientEmail
     * @param $data
     */
    public function mail($fromEmail, $recipientEmail, $data) {
        t3h::Mail()->send(
            $recipientEmail,
            $fromEmail,
            'Debugger',
            'Debug Output',
            print_r($data, true)
        );
    }

    /**
     *
     */
    public function dumpFullTyposcript() {
        $configurationManager = t3h::injectClass(ConfigurationManager::class);
        $extbaseFrameworkConfiguration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $this->dump($extbaseFrameworkConfiguration);
    }

    /**
     * @todo Testen und aufräumen
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     */
    public function query($query) {
        /** @var Typo3DbQueryParser $queryParser */
        $queryParser = t3h::injectClass(\TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser::class);
        $this->dump($queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL());
    }

}