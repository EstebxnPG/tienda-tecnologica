<?php 
include '../../config/conexion.php';

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
            <input type="number" name="precio" id="precio" value="<?= $producto['precio']; ?>" required>

            <label for="categoria">Categoría:</label>
            <select name="categoria_id" id="categoria" required>
                <?php while ($categoria = mysqli_fetch_assoc($resultadoCategorias)) { ?>
                    <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $producto['categoria_id'] ? 'selected' : ''; ?>><?= $categoria['nombre']; ?></option>
                <?php } ?>
            </select>

            <button type="submit" class="button__confirmation">Actualizar Producto</button>
        </form>

        <br>
        <a href="gestionar_producto .php" class="volver button__confirmation">← Volver</a>
    </div>
</div>
<?php include '../../includes/footer.php'; ?>

</body>
</html>
