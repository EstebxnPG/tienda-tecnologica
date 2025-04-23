<!DOCTYPE html>
<html lang="es">
<head>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/head.php'; ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Pedido</title>
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
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }

        h1, h2, h3 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }

        h2 {
            font-size: 1.8rem;
            border-bottom: 2px solid #eee;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }

        h3 {
            font-size: 1.4rem;
            margin-top: 2rem;
        }

        .pedido-info {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            margin-top: 4rem;
            border-left: 4px solid #007832;
            margin-left: -20rem;
        }

        .pedido-info p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
        }

        .pedido-info strong {
            color: #2c3e50;
            min-width: 120px;
            display: inline-block;
        }

        .estado {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: capitalize;
            display: inline-block;
        }

        .estado-pendiente { background-color: #fff3cd; color: #856404; }
        .estado-procesando { background-color: #cce5ff; color: #004085; }
        .estado-enviado { background-color: #d4edda; color: #155724; }
        .estado-entregado { background-color: #c3e6cb; color: #1e7e34; }
        .estado-cancelado { background-color: #f8d7da; color: #721c24; }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 2rem;
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
            background-color: #f9f9f9;
        }

        .precio {
            font-family: 'Roboto Mono', monospace;
            font-weight: 500;
        }

        .total-row {
            font-weight: 700;
            background-color: #f6f8fa;
        }

        .total-row td {
            border-top: 2px solid #ddd;
        }

        .btn-volver {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            margin-left: 10rem;
            margin-top: 13rem;
        }

        .btn-volver:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

            .pedido-info {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "tienda_sena");
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Obtener ID del pedido desde la URL
        $pedido_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($pedido_id <= 0) {
            echo "<p class='error'>ID de pedido inválido.</p>";
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
            $estado_class = 'estado-' . strtolower($pedido['estado']);
            
            echo "<h2>Detalles del Pedido #{$pedido['id']}</h2>";
            echo "<div class='pedido-info'>";
            echo "<p><strong>Cliente:</strong> {$pedido['nombre']} {$pedido['apellidos']}</p>";
            echo "<p><strong>Dirección:</strong> {$pedido['direccion']}, {$pedido['localidad']}, {$pedido['provincia']}</p>";
            echo "<p><strong>Estado:</strong> <span class='estado {$estado_class}'>{$pedido['estado']}</span></p>";
            echo "<p><strong>Fecha:</strong> {$pedido['fecha']} - <strong>Hora:</strong> {$pedido['hora']}</p>";
            echo "<p><strong>Costo Total:</strong> <span class='precio'>$ {$pedido['coste']}</span></p>";
            echo "</div>";
        } else {
            echo "<p class='error'>Pedido no encontrado.</p>";
            exit;
        }

        // Consulta para obtener los productos del pedido
        $sql_productos = "SELECT lp.unidades, pr.nombre, pr.precio
                          FROM lineas_pedidos lp
                          INNER JOIN productos pr ON lp.producto_id = pr.id
                          WHERE lp.pedido_id = $pedido_id";
        $resultado_productos = $conexion->query($sql_productos);

        echo "<h3>Productos en el Pedido</h3>";
        echo "<div class='table-container'>";
        echo "<table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unitario</th>
                        <th>Unidades</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>";

        $total_pedido = 0;
        while ($producto = $resultado_productos->fetch_assoc()) {
            $total_producto = $producto['precio'] * $producto['unidades'];
            $total_pedido += $total_producto;
            echo "<tr>
                    <td>{$producto['nombre']}</td>
                    <td class='precio'>$ {$producto['precio']}</td>
                    <td>{$producto['unidades']}</td>
                    <td class='precio'>$ {$total_producto}</td>
                  </tr>";
        }
        
        echo "<tr class='total-row'>
                <td colspan='3'><strong>Total del Pedido</strong></td>
                <td class='precio'><strong>$ {$total_pedido}</strong></td>
              </tr>";
        echo "</tbody></table></div>";
        echo '<a href="mis_pedidos.php" class="btn-volver">VOLVER</a>';
        $conexion->close();
        ?>
    </div>
    <?php include '../../includes/footer.php'; ?>

</body>
</html>