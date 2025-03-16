<?php


$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'koperasi_pegawai'; 


$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
