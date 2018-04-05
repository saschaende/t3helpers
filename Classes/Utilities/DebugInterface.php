<?php

namespace SaschaEnde\T3helpers\Utilities;

interface DebugInterface {

    /**
     * @param $data
     * @param bool $split
     */
    public function dump($data,$split = false);

    /**
     * @param $fromEmail
     * @param $recipientEmail
     * @param $data
     */
    public function mail($fromEmail, $recipientEmail, $data);

    /**
     *
     */
    public function dumpFullTyposcript();

    /**
     * @todo Testen und aufräumen
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     */
    public function query($query);

}