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
     * @param bool $priority
     * @return bool|mixed
     */
    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody, $attachments = [],$priority = false) {
        // set email settings
        $message = GeneralUtility::makeInstance(MailMessage::class);

        $message->setTo($recipient)
            ->setFrom([$senderEmail => $senderName])
            ->setSubject($subject);

        if($priority){
            $message->setPriority($priority);
        }

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
     * @param bool $priority
     * @param null $controllerContext $controllerContext In your controller action use $this->controllerContext, important for using translation
     * @return bool|mixed
     */
    public function sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = [], $attachments = [],$priority = false, $controllerContext = null) {
        $emailBody = t3h::Template()->render($extension, $path, $variables, $controllerContext);
        return $this->send($recipient, $senderEmail, $senderName, $subject, $emailBody,$attachments,$priority);
    }

}