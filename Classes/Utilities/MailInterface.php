<?php

namespace SaschaEnde\T3helpers\Utilities;

interface MailInterface {

    public function send($recipient, $senderEmail, $senderName, $subject, $emailBody);

}