<?php
include __DIR__ . '/../../config/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $metodo_pago = $_POST['metodo_pago'];

    // Datos simulados o ajustados
    $usuario_id = 1; // Aquí deberías usar el ID real del usuario desde la sesión
    $provincia = "Por definir"; // Puedes agregar un campo si lo necesitas
    $localidad = "Por definir"; // Igual que provincia

    $estado = "confirmado";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    // Calcular el total desde el carrito (simulado desde POST, puedes ajustar)
    $total = 0;
    if (isset($_POST['cantidad']) && is_array($_POST['cantidad'])) {
        foreach ($_POST['cantidad'] as $id => $cantidad) {
            $precio = $_POST['precio'][$id]; // necesitas enviar los precios también en el form
            $total += $precio * $cantidad;
        }
    }

    // Insertar pedido
    $sql = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdsss", $usuario_id, $provincia, $localidad, $direccion, $total, $estado, $fecha, $hora);

    if ($stmt->execute()) {
// Limpiar carrito en sesión
if (isset($_SESSION['carrito'])) {
    unset($_SESSION['carrito']);
}

// Limpiar cookie del carrito
if (isset($_COOKIE['carrito'])) {
    setcookie('carrito', '', time() - 3600, '/');
}


        echo "<script>
        alert('¡Pedido generado corectamente! GRACIAS POR TU COMPRA');
        window.location.href = '/tienda-tecnologica/index.php';
        </script>";
        // Redirigir o mostrar algo aquí
    } else {
        echo "Error al registrar el pedido: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
