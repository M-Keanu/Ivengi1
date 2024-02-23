<?php


    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_csv_program";
    
    $conn = new mysqli($servername, $username, $password, $database);


    $sql = "SELECT MAX(OrderID) AS max_order FROM order_contain";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $orderid = $row["max_order"] + 1;


$csvFile = fopen('importfile_order_645e2833da9a3db27a8b45f2.csv', 'r');



fgetcsv($csvFile);

while (($array = fgetcsv($csvFile)) !== false) {

    $artikel = $array[0];
    $voorraad = $array[4];
    $maat = $array[3];
    $barcode = $array[6];
    $klantid; 
    $OrderID = $orderid;

    $stmt = $conn->prepare("INSERT INTO order_contain (Barcode, Aantal, OrderID, ArtikelNummer, Maat) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $barcode, $voorraad, $OrderID, $artikel, $maat);
    
    $stmt->execute();
    $stmt->close();
    
    $artikel = "";
    $voorraad = "";
    $maat = "";
    $barcode = "";
    
}


    fclose($csvFile);
    $conn->close();
?>
