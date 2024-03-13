<?php

use FTP\Connection;

class Database{
   function Conn($Servername,$Username,$Password,$Database){
    $servername = $Servername;
    $username = $Username;
    $password = $Password;
    $database = $Database;
    
    $conn = new mysqli($servername, $username, $password, $database);

    return $conn;
   } 
}
?>