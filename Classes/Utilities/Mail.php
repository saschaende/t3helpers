<?php

namespace SaschaEnde\T3helpers\Utilities;

use t3h\t3h;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Mail implements MailInterface, SingletonInterface {

    /**
     * @param $recipient
     * @param $senderEmail
     * @param $senderName
     * @param $subject
     * @param $emailBody
     * @param array $attachments
     * @return bool
     */
    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody, $attachments = []) {
        // set email settings
        $message = GeneralUtility::makeInstance(MailMessage::class);

        $message->setTo($recipient)
            ->setFrom([$senderEmail => $senderName])
            ->setSubject($subject);

        $message->setBody($emailBody, 'text/html');

        // Dateianhänge
        foreach ($attachments as $filename => $path) {
            if (trim($filename) && !is_numeric($filename)) {
                $message->attach(\Swift_Attachment::fromPath($path)->setFilename($filename));
            } else {
                $message->attach(\Swift_Attachment::fromPath($path));
            }
        }

        // send now
        $message->send();
        return $message->isSent();
    }

    /**
     * @param $recipient
     * @param $senderEmail
     * @param $senderName
     * @param $subject
     * @param $extension
     * @param $path
     * @param array $variables
     * @param array $attachments
     * @return bool
     */
    public function sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = [], $attachments = []) {
        $emailBody = t3h::Template()->render($extension, $path, $variables);
        return $this->send($recipient, $senderEmail, $senderName, $subject, $emailBody,$attachments);
    }

}