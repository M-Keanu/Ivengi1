<?php

//Keanu

require 'vendor/autoload.php'; //Request PHPMailer > composer file

//Check for emails and fetch emails from mail account

//Connection with mail account (IMAP)
$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Vist@2024!';

//Open mail box and check for e-mails, otherwise echo error message
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

//Sender email address(es) filter
$specificEmailAddress = 'example@example.com';

//Fetch emails from the email address(es) specified above
$emails = imap_search($inbox, 'FROM "'.$specificEmailAddress.'"');

//Echo information in emails: subject, from, message
if ($emails) 
{
    $output = '';
    foreach ($emails as $email_number) {
        $header = imap_headerinfo($inbox, $email_number);
        $from = $header->from;
        $output .= 'Subject: ' . $header->subject . '<br>';
        $output .= "From: " . $from_email . '<br>';
        $output .= "Message: " . $header->text . '<br><br>';
    }
    echo $output;
} 

imap_close($inbox);


//Send e-mail

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'mail.gmx.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'vista.challenge@gmx.net';
    $mail->Password   = 'Vist@2024!';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('vista.challenge@gmx.net', 'Vista'); //From email address
    $mail->addAddress('vista.challenge@gmx.net', 'Send mail test'); //To email address

    $mail->isHTML(true);
    $mail->Subject = 'Test mail'; //Email subject
    $mail->Body    = 'Dit is een test e-mail'; //Email message

    $mail->send();
    echo 'Email has been sent'; //Notification when email is sent
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; //Notification when email is not sent
}

?>