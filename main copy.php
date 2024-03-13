<?php

require 'vendor/autoload.php'; // Include PHPMailer autoloader

// Connection with mail account (IMAP)
$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Ch2lleng3!';

// Open mail box and check for e-mails, otherwise echo an error message
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

// Sender email address(es) filter
$specificEmailAddress = 'kjennoa@gmail.com';

// Fetch emails from the email address(es) specified above
// Fetch emails from the email address(es) specified above
$emails = imap_search($inbox, 'FROM "'.$specificEmailAddress.'"');

// Echo information in emails: subject, from, message
if ($emails) 
{
    $output = '';
    foreach ($emails as $email_number) {
        $header = imap_headerinfo($inbox, $email_number);
        $from = $header->from[0];
        $from_email = $from->mailbox . "@" . $from->host; // Get the full email address
        $output .= 'Subject: ' . $header->subject . '<br>';
        $output .= "From: " . $from_email . '<br>';
        
        // Fetch email structure
        $structure = imap_fetchstructure($inbox, $email_number);
        
        // Initialize variables to store email content
        $textPlain = '';
        $textHtml = '';
        
        // Loop through each MIME part of the email
        if (isset($structure->parts) && is_array($structure->parts)) {
            foreach ($structure->parts as $partNum => $part) {
                // Fetch part content
                $partContent = imap_fetchbody($inbox, $email_number, $partNum + 1);
                
                // Determine content type
                $contentType = strtolower($part->subtype);
                
                // If it's plain text, store it in $textPlain
                if ($contentType === 'plain') {
                    $textPlain .= $partContent;
                }
                // If it's HTML, store it in $textHtml
                elseif ($contentType === 'html') {
                    $textHtml .= $partContent;
                }
            }
        }
        
        // Display email content (HTML if available, otherwise plain text)
        $output .= "Message: " . (!empty($textHtml) ? $textHtml : $textPlain) . '<br><br>';
    }
    echo $output;
} else {
    echo "No emails found."; // Display message if no emails are found
}


// Send e-mail

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // Enable verbose debugging
    $mail->isSMTP();
    $mail->Host = 'mail.gmx.net'; // SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'vista.challenge@gmx.net';
    $mail->Password = 'Ch2lleng3!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
    $mail->Port = 465; // Set the SMTP port for SSL

    $mail->setFrom('vista.challenge@gmx.net', 'Vista'); // From email address
    $mail->addAddress('Kjennoa@gmail.com', 'Send mail test'); // To email address

    $mail->isHTML(true);
    $mail->Subject = 'Test mail'; // Email subject
    $mail->Body    = 'This is a test email'; // Email message

    $mail->send();
    echo 'Email has been sent'; // Notification when email is sent
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Notification when email is not sent
}

?>
