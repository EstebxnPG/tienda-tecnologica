<?php
include '../../config/conexion.php';
include '../../includes/validador.php';


if (!isset($_GET['id'])) {
    echo "ID de producto no proporcionado.";
    exit();
}

$id_producto = $_GET['id'];

// Iniciar transacción para asegurar integridad
$conn->begin_transaction();

try {
    // Primero eliminar las referencias en lineas_pedidos
    $sql_lineas = "DELETE FROM lineas_pedidos WHERE producto_id = ?";
    $stmt_lineas = $conn->prepare($sql_lineas);
    $stmt_lineas->bind_param("i", $id_producto);
    $stmt_lineas->execute();
    $stmt_lineas->close();
    
    // Ahora eliminar el producto
    $sql_producto = "DELETE FROM productos WHERE id = ?";
    $stmt_producto = $conn->prepare($sql_producto);
    $stmt_producto->bind_param("i", $id_producto);
    $stmt_producto->execute();
    $stmt_producto->close();
    
    // Si todo ha ido bien, confirmar los cambios
    $conn->commit();
    
    echo "<script>
            alert('Producto y sus referencias eliminados correctamente.');
            window.location.href = 'gestionar_producto.php';
          </script>";
          
} catch (Exception $e) {
    // Si hay algún error, deshacer los cambios
    $conn->rollback();
    echo "Error al eliminar: " . $e->getMessage();
}

$conn->close();
?>