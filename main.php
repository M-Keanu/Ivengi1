<?php

require 'vendor/autoload.php';
include 'Functions.php';

$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Ch2lleng3!';

// Establishing connection to the IMAP server
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

$sql = "SELECT Email FROM klanten";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$emails = array();
while ($row = $result->fetch_assoc()) {
    $emails[] = $row['Email'];
}

// Initialize an empty array to store search results
$emailsInInbox = array();

// Search for emails from each registered email address separately
foreach ($emails as $email) {
    $search_criteria = 'FROM "' . $email . '"';
    $results = imap_search($inbox, $search_criteria);
    
    // Merge search results
    if ($results !== false) {
        $emailsInInbox = array_merge($emailsInInbox, $results);
    }
}

// Deduplicate the search results
$emailsInInbox = array_unique($emailsInInbox);

$output = ''; // Define the output variable outside the loop

// Fetch information in emails: subject, from, message, and message ID
if ($emailsInInbox) {
    $output = '';
    foreach ($emailsInInbox as $email_number) {
        // Verify that the message number is valid
        if ($email_number > 0) {
            // Fetch the email header
            $header = imap_fetchheader($inbox, $email_number);

            preg_match('/Message-ID:\s*<([^>]*)>/', $header, $matches);
            $messageID = isset($matches[1]) ? $matches[1] : 'N/A';
            
            if(MailID($conn,$messageID)){

                $headerInfo = imap_headerinfo($inbox, $email_number);
                $from = $headerInfo->from[0];
                $from_email = $from->mailbox . "@" . $from->host;
    
                $subject = isset($headerInfo->subject) ? imap_utf8($headerInfo->subject) : 'N/A';
    
                $output .= 'Subject: ' . $subject . '<br>';
                $output .= "From: " . $from_email . '<br>';
                $output .= "Message ID: " . $messageID . '<br>';
    
                $structure = imap_fetchstructure($inbox, $email_number);
    
                if (isset($structure->parts) && is_array($structure->parts)) {
                    $emailBody = '';
                    foreach ($structure->parts as $partNum => $part) {
                        if ($part->type == 0) {
                            $emailBody = imap_fetchbody($inbox, $email_number, $partNum + 1);
                            break;
                        }
                    }
    
                    if ($structure->encoding == 3) {
                        $emailBody = base64_decode($emailBody);
                    }
                    $output .= "Message: " . $emailBody . '<br><br>';
                }
            }


        } 
        else {
            // Handle invalid message number
            echo "Invalid message number: $email_number";
        }
    }
} else {
    echo "No emails found.";
}

echo $output;

// Close the IMAP connection
imap_close($inbox);




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
