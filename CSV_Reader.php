<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_csv_program";
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    
    
    
    
    
    
    $Emailadress = "kjennoa@gmail.com";    

    $sql = "SELECT MAX(OrderID) AS last_order FROM orders";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $orderid = $row["last_order"] + 1;

    $sql = "SELECT KlantID FROM emails WHERE Email = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Emailadress);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $klantid = $row["KlantID"];


switch($klantid){
    case 1:
        $csvFile = fopen('importfile_order_645e2833da9a3db27a8b45f2.csv', 'r');
        break;
    case 2:
        $csvFile = fopen('importfile_order_603fd92fb30e5f465a8b4578.csv', 'r');
        break;
}



fgetcsv($csvFile);

while (($array = fgetcsv($csvFile)) !== false) {
    switch ($klantid) {
        case 1:
            $aantal = $array[4];
            $barcode = $array[6];
            $OrderID = $orderid;
            $klantid = $klantid;
            $stmt = $conn->prepare("INSERT INTO orders (OrderID,Barcode, Aantal,KlantID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $OrderID, $barcode, $aantal,$klantid);
            $stmt->execute();
            $stmt->close();
            break;
        case 2:
            $aantal = $array[6];
            $barcode = $array[4];
            $OrderID = $orderid;
            $klantid = $klantid;

            $stmt = $conn->prepare("INSERT INTO orders (OrderID,Barcode, Aantal,KlantID) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $OrderID, $barcode, $aantal,$klantid);
            $stmt->execute();
            $stmt->close();
            break;
    }
    
}


    fclose($csvFile);
    $conn->close();
?>
       