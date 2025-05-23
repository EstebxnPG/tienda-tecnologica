<?php
include __DIR__ . '/../../config/conexion.php'; 
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente = $_POST['cliente'];
    $numero = $_POST['numero'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $metodo_pago = $_POST['metodo_pago'];
    $usuario_id = $_SESSION['usuario_id'];
    $provincia = $_POST['provincia'];
    $localidad = $_POST['localidad'];

    $estado = "confirmado";
    $fecha = date("Y-m-d");
    $hora = date("H:i:s");

    $total = 0;
    if (isset($_POST['cantidad']) && is_array($_POST['cantidad'])) {
        foreach ($_POST['cantidad'] as $id => $cantidad) {
            $precio = $_POST['precio'][$id]; 
            $total += $precio * $cantidad;
        }
    }

    // Insertar pedido principal (ESTA PARTE FALTABA)
    $sql = "INSERT INTO pedidos (usuario_id, provincia, localidad, direccion, coste, estado, fecha, hora) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdsss", $usuario_id, $provincia, $localidad, $direccion, $total, $estado, $fecha, $hora);

    if ($stmt->execute()) {
        $pedido_id = $conn->insert_id;

        // Insertar productos en lineas_pedidos y actualizar stock
        if (isset($_POST['cantidad']) && is_array($_POST['cantidad'])) {
            foreach ($_POST['cantidad'] as $producto_id => $unidades) {
                if ($unidades > 0) {
                    // Insertar línea de pedido
                    $sql_linea = "INSERT INTO lineas_pedidos (pedido_id, producto_id, unidades) 
                                VALUES (?, ?, ?)";
                    $stmt_linea = $conn->prepare($sql_linea);
                    $stmt_linea->bind_param("iii", $pedido_id, $producto_id, $unidades);
                    $stmt_linea->execute();
                    
                    // Actualizar stock del producto
                    $sql_update = "UPDATE productos SET stock = stock - ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ii", $unidades, $producto_id);
                    $stmt_update->execute();
                }
            }
        }

        // Limpiar carrito
        unset($_SESSION['carrito']);
        if (isset($_COOKIE['carrito'])) {
            setcookie('carrito', '', time() - 3600, '/');
        }

        echo "<script>
        alert('¡Pedido generado correctamente! GRACIAS POR TU COMPRA');
        window.location.href = '/tienda-tecnologica/index.php';
        </script>";
    } else {
        echo "Error al registrar el pedido: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>