<?php
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $usuario_id = intval($_POST['usuario_id']);
    $provincia = $_POST['provincia'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $coste = floatval($_POST['coste']);
    $estado = $_POST['estado'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $stmt = $conn->prepare("UPDATE pedidos SET usuario_id = ?, provincia = ?, localidad = ?, direccion = ?, coste = ?, estado = ?, fecha = ?, hora = ? WHERE id = ?");
    $stmt->bind_param("isssdsssi", $usuario_id, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora, $id);

    if ($stmt->execute()) {
        header('Location: listar_pedido.php');
    } else {
        echo "Error al actualizar el pedido: " . $stmt->error;
    }

    $stmt->close();
} else {
    header('Location: listar_pedido.php');
}

$conn->close();
?>
