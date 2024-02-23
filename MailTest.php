<?php

require 'vendor/autoload.php';

use MailSlurp\Client\Api\InboxControllerApi;
use MailSlurp\Client\Api\EmailControllerApi;
use MailSlurp\Client\Model\CreateInboxDto;
use MailSlurp\Client\Model\SendEmailOptions;

// Your MailSlurp API key
$mailslurpApiKey = 'b0c07a99ead0b67dd4193a6d178547a45bdcafb8b0370dfda8a5a34203cec7e8';

// Initialize the MailSlurp API clients
$inboxApi = new InboxControllerApi(null, $mailslurpApiKey);
$emailApi = new EmailControllerApi(null, $mailslurpApiKey);

// Create a new inbox
$createInboxOptions = new CreateInboxDto();
$inbox = $inboxApi->createInbox($createInboxOptions);

// Use the inbox ID to retrieve its email address
$inboxEmail = $inbox->getEmailAddress();

// Send an email to the created inbox
$sendEmailOptions = new SendEmailOptions([
    'to' => [$inboxEmail],
    'subject' => 'Test Email',
    'body' => '<p>Hello, this is a test email.</p>',
    'isHTML' => true,
]);

$emailApi->sendEmail($sendEmailOptions);

// Retrieve the latest email in the inbox
$latestEmail = $emailApi->getEmails($inbox->getId(), null, null, null, 1)->getContent()[0];

// Display the received email details
echo "Subject: " . $latestEmail->getSubject() . PHP_EOL;
echo "From: " . $latestEmail->getFrom()[0] . PHP_EOL;
echo "Body: " . $latestEmail->getBody() . PHP_EOL;

?>
