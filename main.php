<?php

require 'vendor/autoload.php';
include 'Functions.php';

$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmx.net';
$password = 'Ch2lleng3!';

// Establishing connection to the IMAP server
$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

// Database connection
$conn = DBConnection();

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
        
        // Extract email address from the "From" header using regular expression
        preg_match('/From:.*?<([^>]+)>/i', $header, $matches);
        
        preg_match('/Message-ID:\s*<([^>]*)>/', $header, $matches2);
        $messageID = isset($matches2[1]) ? $matches2[1] : 'N/A';

        if (isset($matches[1]) && MailID($conn,$messageID)) {
            $from_email = $matches[1];


            // Pass the extracted email address to CSVREADER
            $attachments = getAttachments($inbox, $email_number);
            foreach ($attachments as $attachment) {
                // Check if the attachment is a CSV file
                if ($attachment['is_attachment'] && strtolower(pathinfo($attachment['filename'], PATHINFO_EXTENSION)) === 'csv') {
                    // Convert attachment data to a temporary file
                    $tempFile = tempnam(sys_get_temp_dir(), 'email_attachment');
                    file_put_contents($tempFile, $attachment['attachment']);

                    // Open the temporary file handle for reading
                    $csvFileHandle = fopen($tempFile, 'r');

                    // Pass the file handle to CSVREADER
                    CSVREADER($conn, $from_email, $csvFileHandle);

                    // Close the file handle and remove the temporary file
                    fclose($csvFileHandle);
                    unlink($tempFile);
                }
            }

            // Use the sender's email address as the recipient address for the email you're sending
            $EmailSubject = "Bestelling Bevestiging";
            $EmailMessage = "Je bestelling is bevestigd.";
            MailSender($from_email, $EmailSubject, $EmailMessage);
        } else {
            echo "Failed to extract sender's email address from the email headers.";
        }
    }
}

imap_close($inbox);
?>
