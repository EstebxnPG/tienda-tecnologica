<?php
include '../../config/conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmt = $conn->prepare("DELETE FROM pedidos WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: listar_pedido.php');
    } else {
        echo "Error al eliminar el pedido: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    header('Location: listar_pedido.php');
}

$conn->close();
?>
