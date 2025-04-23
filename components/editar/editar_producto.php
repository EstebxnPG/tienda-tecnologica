<?php 
include '../../config/conexion.php';
include '../../includes/validador.php';


// Obtener el ID del producto a editar
if (!isset($_GET['id'])) {
    echo "Producto no encontrado.";
    exit();
}

$id_producto = $_GET['id'];

// Obtener producto
$queryProducto = "SELECT * FROM productos WHERE id = ?";
$stmt = $conn->prepare($queryProducto);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$resultadoProducto = $stmt->get_result();
$producto = $resultadoProducto->fetch_assoc();

// Obtener categorías
$queryCategorias = "SELECT * FROM categorias ORDER BY nombre ASC";
$resultadoCategorias = mysqli_query($conn, $queryCategorias);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria_id = $_POST['categoria_id'];

    // Actualizar producto
    $sql = "UPDATE productos SET nombre = ?, precio = ?, categoria_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $nombre, $precio, $categoria_id, $id_producto);

    if ($stmt->execute()) {
        echo "<script>
                alert('¡Producto actualizado correctamente!');
                window.location.href = '../../index.php';
              </script>";
    } else {
        echo "Error al actualizar el producto: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos generales */
        .super__container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .title__container {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }

        /* Estilos del formulario */
        .formulario {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .formulario label {
            font-weight: 600;
            color: #34495e;
            margin-bottom: -0.8rem;
        }

        .formulario input,
        .formulario select {
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .formulario input:focus,
        .formulario select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        /* Estilos de botones */
        .button__confirmation {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.2s;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .button__confirmation:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }

        .button__confirmation:active {
            transform: translateY(0);
        }

        /* Botón Volver */
        .volver {
            background-color: #95a5a6;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .volver:hover {
            background-color: #7f8c8d;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .super__container {
                padding: 0 0.5rem;
            }
            
            .container {
                padding: 1.5rem;
            }
            
            .title__container {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<?php include '../../includes/head.php'; ?>

<body>

<?php include '../../includes/header.php'; ?>

<div class="super__container">
    <div class="container">
        <h2 class="title__container">Editar Producto</h2> 

        <form action="editar_producto.php?id=<?= $id_producto ?>" method="POST" class="formulario">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" value="<?= $producto['nombre']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" value="<?= $producto['precio']; ?>" required step="0.01" min="0">

            <label for="categoria">Categoría:</label>
            <select name="categoria_id" id="categoria" required>
                <?php 
                // Reiniciar el puntero del resultado para poder iterar nuevamente
                mysqli_data_seek($resultadoCategorias, 0);
                while ($categoria = mysqli_fetch_assoc($resultadoCategorias)) { ?>
                    <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $producto['categoria_id'] ? 'selected' : ''; ?>><?= $categoria['nombre']; ?></option>
                <?php } ?>
            </select>

            <button type="submit" class="button__confirmation">Actualizar Producto</button>
        </form>

        <br>
        <a href="gestionar_producto.php" class="volver button__confirmation">← Volver</a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>

</body>
</html>
