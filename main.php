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
$emails = imap_search($inbox, 'FROM "'.$specificEmailAddress.'"');

// Echo information in emails: subject, from, message, and message ID
if ($emails) {
    $output = '';
    foreach ($emails as $email_number) {
        $header = imap_fetchheader($inbox, $email_number); // Fetch raw email headers
        
        // Extract Message-ID using regular expression
        preg_match('/Message-ID:\s*<([^>]*)>/', $header, $matches);
        $messageID = isset($matches[1]) ? $matches[1] : 'N/A'; // Get the extracted Message-ID, or set to 'N/A' if not found
        
        // Fetch email header info
        $headerInfo = imap_headerinfo($inbox, $email_number);
        $from = $headerInfo->from[0];
        $from_email = $from->mailbox . "@" . $from->host; // Get the full email address
        
        // Fetch and decode subject
        $subject = isset($headerInfo->subject) ? imap_utf8($headerInfo->subject) : 'N/A';
        
        $output .= 'Subject: ' . $subject . '<br>'; 
        $output .= "From: " . $from_email . '<br>';
        $output .= "Message ID: " . $messageID . '<br>'; // Display Message-ID
        
        // Fetch email structure
        $structure = imap_fetchstructure($inbox, $email_number);
        
        // Fetch email body
        if (isset($structure->parts) && is_array($structure->parts)) {
            $emailBody = '';
            foreach ($structure->parts as $partNum => $part) {
                if ($part->type == 0) {
                    // Fetch email body
                    $emailBody = imap_fetchbody($inbox, $email_number, $partNum + 1);
                    break; // Stop searching after finding the first text/plain part
                }
            }
            // Decode the email body if it's base64 encoded
            if ($structure->encoding == 3) {
                $emailBody = base64_decode($emailBody);
            }
            $output .= "Message: " . $emailBody . '<br><br>';
        }
    }
    echo $output;
} else {
    echo "No emails found."; // Display message if no emails are found
}





// Send e-mail

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true);

// try {
//     $mail->SMTPDebug = 2; // Enable verbose debugging
//     $mail->isSMTP();
//     $mail->Host = 'mail.gmx.net'; // SMTP server
//     $mail->SMTPAuth = true;
//     $mail->Username = 'vista.challenge@gmx.net';
//     $mail->Password = 'Ch2lleng3!';
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
//     $mail->Port = 465; // Set the SMTP port for SSL

//     $mail->setFrom('vista.challenge@gmx.net', 'Vista'); // From email address
//     $mail->addAddress('Kjennoa@gmail.com', 'Send mail test'); // To email address

//     $mail->isHTML(true);
//     $mail->Subject = 'Test mail'; // Email subject
//     $mail->Body    = 'This is a test email'; // Email message

//     $mail->send();
//     echo 'Email has been sent'; // Notification when email is sent
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Notification when email is not sent
// }

// ?>
