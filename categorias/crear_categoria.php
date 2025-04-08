<?php
include '../register/conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nombre = trim($_POST['nombre']);

    if(!empty($nombre)){
        $sql = "INSERT INTO categorias(nombre) VALUES ('$nombre')";

        if(mysqli_query($conn, $sql)){
            echo "<script>alert('Categoría creada correctamente'); window.location.href='categorias.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conexion);
        }

    } else {
        echo "<script>alert('El nombre no puede estar vacío'); window.history.back();</script>";
    }
}
?>
