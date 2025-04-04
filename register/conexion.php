<?php
$servername = "localhost"; 
$username = "root"; 
$password = "123456"; 
$database = "thetecmens"; 


$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>

/* Stephanny cruz */