<?php
session_start();

if (!isset($_SESSION['email'])) {
    echo "<script>alert('Debes iniciar sesión para agregar productos al carrito.'); window.location.href = 'index.php';</script>";
    exit;
}

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si el producto ya está en el carrito, suma 1
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]++;
    } else {
        $_SESSION['carrito'][$producto_id] = 1;
    }

    $cantidad_total = array_sum($_SESSION['carrito']);

    echo "<script>alert('¡Producto agregado al carrito!'); window.location.href = '../../index.php';</script>";
    exit;
}

echo "<script>alert('Petición no válida.'); window.location.href = '../../index.php';</script>";
?>
