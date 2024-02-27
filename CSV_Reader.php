<?php

    // verbind met de database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_csv_program";
    
    $conn = new mysqli($servername, $username, $password, $database);

    // kijkt in de database wat de laatste orderID is en maakt de nieuwe aan
    $sql = "SELECT MAX(OrderID) AS last_order FROM orders";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $orderid = $row["last_order"] + 1;

//opend het bestand
$csvFile = fopen('importfile_order_645e2833da9a3db27a8b45f2.csv', 'r');


//haalt de eerste rij met de namen uit de file
fgetcsv($csvFile);

//zolang als dat er nog een rij in het bestand zit blijft hij opnieuw de code uitvoeren
while (($array = fgetcsv($csvFile)) !== false) {
    // stopt de belangerijke stukken uit de array in variabelen
    $artikel = $array[0];
    $voorraad = $array[4];
    $maat = $array[3];
    $barcode = $array[6];
    $klantid; 
    $OrderID = $orderid;

    //stopt de data in de database
    $stmt = $conn->prepare("INSERT INTO orders (Barcode, Aantal, OrderID, ArtikelNummer, Maat) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $barcode, $voorraad, $OrderID, $artikel, $maat);
    
    //voert de code uit
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
       