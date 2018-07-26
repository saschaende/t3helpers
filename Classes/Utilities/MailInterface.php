<?php

namespace SaschaEnde\T3helpers\Utilities;

interface MailInterface {

    /**
     * @param $recipient
     * @param $senderEmail
     * @param $senderName
     * @param $subject
     * @param $emailBody
     * @param array $attachments
     * @return bool
     */
    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody, $attachments = []);

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
    public function sendTemplate($recipient, $senderEmail, $senderName, $subject, $extension, $path, $variables = [], $attachments = []);

}