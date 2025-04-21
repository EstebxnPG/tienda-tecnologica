<?php
session_start();
include __DIR__ . '/../../config/conexion.php'; 

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
        
        echo "<script>
        alert('¡Eliminado producto correctamente!');
        window.location.href = 'carrito.php';
        </script>";
        exit();
    } else {
        header("Location: carrito.php?mensaje=El producto no está en el carrito");
        exit();
    }
} else {
    header("Location: carrito.php?mensaje=Producto no especificado");
    exit();
}
?>
