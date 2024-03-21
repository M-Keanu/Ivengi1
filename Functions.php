<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function DBConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_csv_program";
    
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function CSVREADER($conn, $Emailadress, $csvFile) {
    $sql = "SELECT KlantID FROM klanten WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Emailadress);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $klantid = $row["KlantID"];
    
    // Handle the case where 'KlantID' is null
    if ($klantid !== null) {
        $stmt = $conn->prepare("INSERT INTO orders (KlantID) VALUES (?)");
        $stmt->bind_param("s", $klantid);
        $stmt->execute();

        $sql = "SELECT MAX(OrderNummer) AS last_order FROM orders";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $ordernummer = $row["last_order"];

        fgetcsv($csvFile);

        while (($array = fgetcsv($csvFile)) !== false) {
            if (isset($array[4]) && isset($array[6])) {
                switch ($Emailadress) {
                    case "kjennoa@gmail.com":
                        $aantal = $array[4];
                        $barcode = $array[6];
                        break;
                    case "CSV file 2":
                        $aantal = $array[6];
                        $barcode = $array[4];
                        break;
                }
                $OrderNummer = $ordernummer;
                $klantid = $klantid;
                $stmt = $conn->prepare("INSERT INTO orderline (OrderNummer,Barcode, Aantal) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $OrderNummer, $barcode, $aantal);
                $stmt->execute();
            }
        }
    }
}

function MailID($conn, $messageID) {
    $sql = "SELECT * FROM emailid WHERE EmailID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $messageID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return false;
    } else {
        $stmt = $conn->prepare("INSERT INTO emailid (EmailID) VALUES (?)");
        $stmt->bind_param("s",$messageID);
        $stmt->execute();
        $stmt->close();
        return true;
    } 
}

function MailSender($Mailadress, $MailSubject, $MailMessage) {
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

        $mail->setFrom('vista.challenge@gmx.net',"gebruikte mail"); // From email address
        $mail->addAddress($Mailadress); // To email address

        $mail->isHTML(true);
        $mail->Subject = $MailSubject; // Email subject
        $mail->Body    = $MailMessage; // Email message

        $mail->send();
        echo 'Email has been sent'; // Notification when email is sent
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Notification when email is not sent
    }
}

// Helper function to extract attachments from email
function getAttachments($inbox, $email_number) {
    $structure = imap_fetchstructure($inbox, $email_number);
    $attachments = array();
    if (isset($structure->parts) && count($structure->parts)) {
        for ($i = 0; $i < count($structure->parts); $i++) {
            $attachments[$i] = array(
                'is_attachment' => false,
                'filename' => '',
                'attachment' => ''
            );

            if ($structure->parts[$i]->ifdparameters) {
                foreach ($structure->parts[$i]->dparameters as $object) {
                    if (strtolower($object->attribute) == 'filename') {
                        $attachments[$i]['is_attachment'] = true;
                        $attachments[$i]['filename'] = $object->value;
                    }
                }
            }

            if ($attachments[$i]['is_attachment']) {
                $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i + 1);
                if ($structure->parts[$i]->encoding == 3) { // 3 = BASE64
                    $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                } elseif ($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
                    $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                }
            }
        }
    }
    return $attachments;
}

?>
