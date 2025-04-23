<?php
include '../../config/conexion.php';

if (!isset($_GET['id'])) {
    header('Location: listar_pedido.php');
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$pedido = $resultado->fetch_assoc();

if (!$pedido) {
    header('Location: listar_pedido.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.75rem;
            font-weight: 700;
        }

        .form-row {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            flex: 1;
            min-width: 0;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 500;
            font-size: 0.95rem;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #007832;
            box-shadow: 0 0 0 3px rgba(0,120,50,0.1);
        }

        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #007832;
            color: white;
        }

        .btn-primary:hover {
            background-color: #005d27;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .card {
                padding: 1.5rem;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Editar Pedido</h1>
            <form action="actualizar_pedido.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $pedido['id']; ?>">
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="usuario_id">ID de Usuario</label>
                        <input type="number" name="usuario_id" id="usuario_id" value="<?php echo $pedido['usuario_id']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" id="provincia" value="<?php echo $pedido['provincia']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="localidad">Localidad</label>
                        <input type="text" name="localidad" id="localidad" value="<?php echo $pedido['localidad']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" id="direccion" value="<?php echo $pedido['direccion']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="coste">Coste</label>
                        <input type="number" name="coste" id="coste" step="0.01" value="<?php echo $pedido['coste']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" required>
                            <?php
                            $estados = ['pendiente', 'procesando', 'enviado', 'entregado', 'cancelado'];
                            foreach ($estados as $estado): 
                                $selected = ($estado === $pedido['estado']) ? 'selected' : '';
                            ?>
                                <option value="<?php echo $estado; ?>" <?php echo $selected; ?>><?php echo ucfirst($estado); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="<?php echo $pedido['fecha']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" value="<?php echo $pedido['hora']; ?>" required>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="listar_pedido.php" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
$stmt->close();
$conn->close(); 
?>
