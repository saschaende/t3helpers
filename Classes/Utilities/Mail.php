<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Mail implements SingletonInterface {

    public function sendMail($recipient, $senderEmail, $senderName, $subject, $emailBody) {
        // set email settings
        $message = GeneralUtility::makeInstance(MailMessage::class);

        $message->setTo($recipient)
            ->setFrom([$senderEmail => $senderName])
            ->setSubject($subject);

        $message->setBody($emailBody, 'text/html');

        // send now
        $message->send();
        return $message->isSent();
    }

}