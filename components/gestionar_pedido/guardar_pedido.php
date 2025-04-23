<?php
include '../../config/conexion.php';

$usuario_id = $_POST['usuario_id'];
$provincia = $_POST['provincia'];
$localidad = $_POST['localidad'];
$direccion = $_POST['direccion'];
$coste = $_POST['coste'];
$estado = $_POST['estado'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$query = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("isssdsss", $usuario_id, $provincia, $localidad, $direccion, $coste, $estado, $fecha, $hora);

if ($stmt->execute()) {
    header('Location: listar_pedido.php');
} else {
    echo "Error al guardar el pedido: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
