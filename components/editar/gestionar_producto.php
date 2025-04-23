<?php 
include '../../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Cargando jQuery -->
    <script src="app.js"></script> 
    <link href="style.css" rel="stylesheet" type="text/css">
    <?php include '../../includes/head.php'; ?>
</head>
<body>
    <?php include '../../includes/header.php'; ?>

<div class="super__container">
    <div class="container">
        <h2 class="title__container">Listado de Productos</h2>

        <table class="form login__form" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT p.id, p.nombre, p.precio, c.nombre as categoria FROM productos p JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC";
                $resultado = mysqli_query($conn, $query);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr id='producto-" . $fila['id'] . "'>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td id='nombre-" . $fila['id'] . "'>" . $fila['nombre'] . "</td>";
                    echo "<td id='precio-" . $fila['id'] . "'>" . $fila['precio'] . "</td>";
                    echo "<td id='categoria-" . $fila['id'] . "'>" . $fila['categoria'] . "</td>";
                    echo "<td>
                        <button onclick='editarProducto(" . $fila['id'] . ")'>Editar</button>
                        <button class='eliminar__boton' onclick='eliminarProducto(" . $fila['id'] . ")'>Eliminar</button>
                    </td>
                    ";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <div class="botones__producto">
            <a href="../productos/crear_producto.php" class="button__confirmation">CREAR UN PRODUCTO</a>
            <a href="/tienda-tecnologica/index.php" class="volver">← Volver</a>
        </div>
    </div>
</div>
<script>
    function editarProducto(id) {
        // Redirigir a la página de edición pasando el ID del producto en la URL
        window.location.href = 'editar_producto.php?id=' + id;
    }
    
</script>

<script>
function eliminarProducto(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        window.location.href = 'eliminar_producto.php?id=' + id;
    }
}
</script>

</body>
</html>
