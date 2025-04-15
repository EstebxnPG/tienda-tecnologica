<?php 
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $sql = "UPDATE categorias SET nombre = '$nombre' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo 'ok';
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}
?>
