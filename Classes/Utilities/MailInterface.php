<?php

namespace SaschaEnde\T3helpers\Utilities;

interface MailInterface {

    /**
     * @param $recipient
     * @param $senderEmail
     * @param $senderName
     * @param $subject
     * @param $emailBody
     * @return bool
     */
    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody);

    /**
     * @param $recipient
     * @param $senderEmail
     * @param $senderName
     * @param $subject
     * @param $extension
     * @param $path
     * @param array $variables
     * @return bool
     */
    public function sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = []);

}