
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 700;
        }

        .actions-bar {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-nuevo {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #007832;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-nuevo:hover {
            background-color: #005d27;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f6f8fa;
            font-weight: 500;
            color: #2c3e50;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .estado {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: capitalize;
        }

        .estado-pendiente { background-color: #fff3cd; color: #856404; }
        .estado-procesando { background-color: #cce5ff; color: #004085; }
        .estado-enviado { background-color: #d4edda; color: #155724; }
        .estado-entregado { background-color: #c3e6cb; color: #1e7e34; }
        .estado-cancelado { background-color: #f8d7da; color: #721c24; }

        .acciones {
            display: flex;
            gap: 0.5rem;
        }

        .btn-accion {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-editar {
            background-color: #007bff;
            color: white;
        }

        .btn-editar:hover {
            background-color: #0056b3;
        }

        .btn-eliminar {
            background-color: #dc3545;
            color: white;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
        }

        .precio {
            font-family: 'Roboto Mono', monospace;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 0.75rem;
            }
        }
    </style>
</head>
<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "tienda_sena");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener ID del pedido desde la URL
$pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($pedido_id <= 0) {
    echo "ID de pedido inválido.";
    exit;
}

// Consulta para obtener datos del pedido
$sql_pedido = "SELECT p.*, u.nombre, u.apellidos 
               FROM pedidos p 
               INNER JOIN usuarios u ON p.usuario_id = u.id 
               WHERE p.id = $pedido_id";
$resultado_pedido = $conexion->query($sql_pedido);

if ($resultado_pedido->num_rows > 0) {
    $pedido = $resultado_pedido->fetch_assoc();
    echo "<h2>Detalles del Pedido #{$pedido['id']}</h2>";
    echo "<p><strong>Cliente:</strong> {$pedido['nombre']} {$pedido['apellidos']}</p>";
    echo "<p><strong>Dirección:</strong> {$pedido['direccion']}, {$pedido['localidad']}, {$pedido['provincia']}</p>";
    echo "<p><strong>Estado:</strong> {$pedido['estado']}</p>";
    echo "<p><strong>Fecha:</strong> {$pedido['fecha']} - <strong>Hora:</strong> {$pedido['hora']}</p>";
    echo "<p><strong>Costo Total:</strong> $ {$pedido['coste']}</p>";
} else {
    echo "Pedido no encontrado.";
    exit;
}

// Consulta para obtener los productos del pedido
$sql_productos = "SELECT lp.unidades, pr.nombre, pr.precio
                  FROM lineas_pedidos lp
                  INNER JOIN productos pr ON lp.producto_id = pr.id
                  WHERE lp.pedido_id = $pedido_id";
$resultado_productos = $conexion->query($sql_productos);

echo "<h3>Productos en el Pedido:</h3>";
echo "<table border='1' cellpadding='8'>
        <tr>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Unidades</th>
            <th>Total</th>
        </tr>";

while ($producto = $resultado_productos->fetch_assoc()) {
    $total_producto = $producto['precio'] * $producto['unidades'];
    echo "<tr>
            <td>{$producto['nombre']}</td>
            <td>$ {$producto['precio']}</td>
            <td>{$producto['unidades']}</td>
            <td>$ {$total_producto}</td>
          </tr>";
}
echo "</table>";

$conexion->close();
?>
