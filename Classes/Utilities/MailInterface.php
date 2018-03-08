<?php

namespace SaschaEnde\T3helpers\Utilities;

interface MailInterface {

    public function sendMail($recipient, $senderEmail, $senderName, $subject, $emailBody);

}