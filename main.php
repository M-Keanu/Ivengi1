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
        $email_number = (int) $email_number; //Make sure $email_number is an integer
        $header = imap_fetchheader($inbox, $email_number); // Fetch email headers
        
        // Extract Message-ID using regular expression
        preg_match('/Message-ID:\s*<([^>]*)>/', $header, $matches);
        $messageID = isset($matches[1]) ? $matches[1] : 'N/A'; // Get the extracted Message-ID, or set to 'N/A' if not found
        
        if(MailID($conn,$messageID)){

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
                                $filename = $object->value;
                                // Save the attachment in the folder CSVfile
                                file_put_contents($folder . DIRECTORY_SEPARATOR . $object->value, $attachment);

                                $csvFilePath = "CSVfile/" . $filename;
                                $csvFile = fopen($csvFilePath, "r");
                                CSVREADER($conn, $Emailadress, $csvFile);
                                fclose($csvFile);
                            }
                        }
                    }
                }
            }
        }
    }
}
}

// Close the IMAP connection
imap_close($inbox);


$EmailSubject = "Bestelling Bevestiging";
$EmailMessage = "Je bestelling is bevestigd.";
MailSender($Emailadress,$EmailSubject,$EmailMessage);


?>
