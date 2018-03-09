<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Mail implements SingletonInterface {

    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody) {
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

    public function sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = []){
        $emailBody = \T3h\Template()->render($extension, $path, $variables);
        return $this->send($recipient, $senderEmail, $senderName, $subject, $emailBody);
    }

}