<?php
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $query = "DELETE FROM categorias WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'ok';
    } else {
        echo 'error';
    }
}
?>
