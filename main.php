<?php

require 'vendor/autoload.php';
include 'Functions.php';

$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Ch2lleng3!';
$conn = DBConnection();
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

$emailsInInbox = array();

foreach ($emails as $email) {
    $search_criteria = 'FROM "' . $email . '"';
    $results = imap_search($inbox, $search_criteria);
    
    if ($results !== false) {
        $emailsInInbox = array_merge($emailsInInbox, $results);
    }
}

$emailsInInbox = array_unique($emailsInInbox);

$output = '';

// Fetch information in emails: subject, from, message, and message ID
if ($emailsInInbox) {
    $output = '';
    foreach ($emailsInInbox as $email_number) {
<<<<<<< HEAD
        $email_number = (int) $email_number; //Make sure $email_number is an integer
        $header = imap_fetchheader($inbox, $email_number); // Fetch email headers
        
        // Extract Message-ID using regular expression
        preg_match('/Message-ID:\s*<([^>]*)>/', $header, $matches);
        $messageID = isset($matches[1]) ? $matches[1] : 'N/A'; // Get the extracted Message-ID, or set to 'N/A' if not found
        
        // Fetch email header info
        $headerInfo = imap_headerinfo($inbox, $email_number);
        $from = $headerInfo->from[0];
        $from_email = $from->mailbox . "@" . $from->host; // Get the full email address
        
        // Fetch and decode subject
        $subject = isset($headerInfo->subject) ? imap_utf8($headerInfo->subject) : 'N/A';

        // Fetch the structure of the email
        $structure = imap_fetchstructure($inbox, $email_number);

        // Define the path to the CSVfile folder
        $folder = __DIR__ . DIRECTORY_SEPARATOR . 'CSVfile';
        
        // Check if the directory exists
        if (!is_dir($folder)) {
        // Directory does not exist, so let's create it
        mkdir($folder, 0777, true);
        }

        if(isset($structure->parts) && count($structure->parts)) {
            for($i = 0; $i < count($structure->parts); $i++) {
                if($structure->parts[$i]->ifdparameters) {
                    foreach($structure->parts[$i]->dparameters as $object) {
                        if(strtolower($object->attribute) == 'filename') {
                            if(pathinfo($object->value, PATHINFO_EXTENSION) == 'csv') {
                                $attachment = imap_fetchbody($inbox, $email_number, $i+1);

                                if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                                    $attachment = base64_decode($attachment);
                                }
                                elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                                    $attachment = quoted_printable_decode($attachment);
                                }

                                // Save the attachment in the folder CSVfile
                                file_put_contents($folder . DIRECTORY_SEPARATOR . $object->value, $attachment);
                            }
=======
        if ($email_number > 0) {
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
>>>>>>> cf3db71581cb3924a2e73376c5a3104b06adb825
                        }
                    }
                }
                $CSVFileName = "filename.csv";

                $csvFilePath = "CSV/" . $csvFileName;
                $csvFile = fopen($csvFilePath, "r");
                CSVREADER($conn, $Emailadress, $csvFile);
                fclose($csvFile);
            }
<<<<<<< HEAD
=======
        } 
        else {
            echo "Invalid message number: $email_number";
>>>>>>> cf3db71581cb3924a2e73376c5a3104b06adb825
        }
    }
}

<<<<<<< HEAD
// Close the IMAP connection
=======
echo $output;


>>>>>>> cf3db71581cb3924a2e73376c5a3104b06adb825
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
