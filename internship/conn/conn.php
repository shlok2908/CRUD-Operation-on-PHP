<?php 

$servername = "localhost";
$username = "root";
$password = "";
$db = "db";

try {


    
    $conn = new PDO("mysqlii:host=$servername;dbname=$db", $username, $password);



    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

?>