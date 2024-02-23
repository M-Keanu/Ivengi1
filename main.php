<?php

//Keanu
//Connection with mail account (IMAP)
$hostname = '{imap.gmx.net:993/imap/ssl}INBOX';
$username = 'e-mailadres';
$password = '';

$inbox = imap_open($hostname, $username, $password) or die('Cannot connect to mail account: ' . imap_last_error());

//Fetch e-mails
$emails = imap_search($inbox, 'ALL');

foreach ($emails as $email_number) {
    $overview = imap_fetch_overview($inbox, $email_number, 0);
    echo 'Subject: ' . $overview[0]->subject . '<br>';
}

imap_close($inbox);

?>