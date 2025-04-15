<?php 
include '../../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías</title>
    <link rel="stylesheet" href="styles.css">
    <?php include '../../includes/head.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Cargar jQuery -->
    <script src="app.js"></script> <!-- Incluir el archivo JS desde la carpeta categorias -->
</head>
<body>

<?php include '../../includes/header.php'; ?>

<div class="super__container">
    <div class="container">
        <h2 class="title__container">Listado de Categorías</h2>

        <table class="form login__form" border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $query = "SELECT * FROM categorias ORDER BY id DESC";
                $resultado = mysqli_query($conn, $query);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr id='categoria-" . $fila['id'] . "'>";
                    echo "<td>" . $fila['id'] . "</td>";
                    echo "<td id='nombre-" . $fila['id'] . "'>" . $fila['nombre'] . "</td>";
                    echo "<td>
                        <button onclick='editarCategoria(" . $fila['id'] . ")'>Editar</button>
                        <button onclick='eliminarCategoria(" . $fila['id'] . ")'>Eliminar</button>
                    </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <br>
        <a href="categorias.php" class="volver">← Volver a Crear Categoría</a>
    </div>
</div>

</body>
</html>
