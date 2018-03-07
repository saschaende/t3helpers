<?php

namespace SaschaEnde\T3helpers\Utilities;

class Mail {

    public static function sendMail($recipient, $senderEmail, $senderName, $subject, $emailBody) {
        // set email settings
        $message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Mail\MailMessage');

        $message->setTo($recipient)
            ->setFrom([$senderEmail => $senderName])
            ->setSubject($subject);

        $message->setBody($emailBody, 'text/html');

        // send now
        $message->send();
        return $message->isSent();
    }

}