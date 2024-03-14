<?php

function DBConnection(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_csv_program";
    
    $conn = new mysqli($servername, $username, $password, $database);
    return $conn;
}
$conn = DBConnection();
$Emailadress = "kjennoa@gmail.com"; 

function CSVREADER($conn,$Emailadress,$csvFile){

    $sql = "SELECT KlantID FROM klanten WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Emailadress);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $klantid = $row["KlantID"];
    
    $stmt = $conn->prepare("INSERT INTO orders (KlantID) VALUES (?)");
    $stmt->bind_param("s",$klantid);
    $stmt->execute();

    $sql = "SELECT MAX(OrderNummer) AS last_order FROM orders";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $ordernummer= $row["last_order"];
    

    fgetcsv($csvFile);

    while (($array = fgetcsv($csvFile)) !== false) {
        switch ($Emailadress) {
            case "kjennoa@gmail.com":
                $aantal = $array[4];
                $barcode = $array[6];
                $OrderNummer = $ordernummer;
                $klantid = $klantid;
                $stmt = $conn->prepare("INSERT INTO orderline (OrderNummer,Barcode, Aantal) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $OrderNummer, $barcode, $aantal);
                $stmt->execute();
                $stmt->close();
                break;
            case "CSV file 2":
                $aantal = $array[6];
                $barcode = $array[4];
                $OrderNummer = $ordernummer;
                $klantid = $klantid;
                $stmt = $conn->prepare("INSERT INTO orderline (OrderNummer,Barcode, Aantal) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $OrderNummer, $barcode, $aantal);
                $stmt->execute();
                $stmt->close();
                break;
        }
    }
        fclose($csvFile);  
} 

function MailID($conn,$messageID){

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

?>
       