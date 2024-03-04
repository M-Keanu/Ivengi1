<?php

require 'vendor/autoload.php';

//Keanu
//Connection with mail account (IMAP)
$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Vist@2024!';

$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

//Fetch e-mails
$emails = imap_search($inbox, 'ALL');

// foreach ($emails as $email_number) {
//     $overview = imap_fetch_overview($inbox, $email_number, 0);
//     echo 'Subject: ' . $overview[0]->subject . '<br>';
//     echo "From: " . $overview->from[0] . '<br>';
//     echo "Message: " . $overview->message[0] . '<br><br>';
// }

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

    $mail->setFrom('vista.challenge@gmx.net', 'Vista');
    $mail->addAddress('vista.challenge@gmx.net', 'Send mail test');

    $mail->isHTML(true);
    $mail->Subject = 'Test mail';
    $mail->Body    = 'Dit is een test e-mail';

    $mail->send();
    echo 'Email has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>