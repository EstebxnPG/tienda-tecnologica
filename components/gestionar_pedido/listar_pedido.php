<?php
include '../../config/conexion.php';
include '../../includes/validador.php';


$resultado = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
?>

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
            margin-top: 3rem;
        }

        .button{
    background:#DF691A;
    text-decoration: none;
    padding: 15px;
    margin-top: 15px;
    border-radius: 5px;
    color:  #f2f2f2;
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

<body>
    <div class="container">
        <div class="actions-bar">
            <h1>Gestión de Pedidos</h1>
            <a class="button" href="../../index.php">VOLVER</a>
            
        </div>
        
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario ID</th>
                        <th>Provincia</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                        <th>Coste</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($pedido = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($pedido['id']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['usuario_id']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['provincia']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['localidad']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['direccion']); ?></td>
                        <td class="precio">(USD)<?php echo number_format($pedido['coste'], 2); ?></td>
                        <td>
                            <span class="estado estado-<?php echo strtolower($pedido['estado']); ?>">
                                <?php echo ucfirst($pedido['estado']); ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['hora']); ?></td>
                        <td class="acciones">
                            <a href="editar_pedido.php?id=<?php echo $pedido['id']; ?>" class="btn-accion btn-editar">Editar</a>
                            <a href="eliminar_pedido.php?id=<?php echo $pedido['id']; ?>" 
                               onclick="return confirm('¿Está seguro de que desea eliminar este pedido?')" 
                               class="btn-accion btn-eliminar">Eliminar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
