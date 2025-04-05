<?php
$host = "localhost";
$user = "root";
$password = ""; // Sin contraseña por defecto en XAMPP
$database = "tienda_sena"; // Asegúrate de que esta base existe en phpMyAdmin

$conn = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}
?>
