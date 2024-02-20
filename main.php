<?php

//Keanu
//Connection with Gmail account
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'vista.challenge@gmail.com';
$password = 'Vist@2024!';

$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

//Fetch e-mails from Gmail
$emails = imap_search($inbox, 'ALL');

foreach ($emails as $email_number) {
    $overview = imap_fetch_overview($inbox, $email_number, 0);
    echo 'Subject: ' . $overview[0]->subject . '<br>';
}

imap_close($inbox);

?>