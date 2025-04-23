<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THETECMENS - Crear Categoría</title>
    <link rel="stylesheet" href="../Login/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <?php include '../../includes/head.php'; ?>
</head>
<body>

<?php include '../../includes/header.php'; 
include '../../includes/validador.php';?>


    <div class="super__container">
        <div class="container">
            
            <div class="login__container">
                <img src="/STYLES_index_login/img/logo-sena.png" alt="" class="logo__container">
                <h2 class="title__container">Crear Categoría</h2>

                <form class="form login__form" method="POST" action="crear_categoria.php">
                    <label class="form__label" for="nombre">Nombre de la Categoría</label>
                    <input type="text" class="form__input" id="nombre" name="nombre" placeholder="Ej: Tecnología" required>
                    
                    <button type="submit" class="login-button__form">CREAR CATEGORÍA</button>
                    <a href="listar_categoria.php" class="">LISTADO CATEGORIAS</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<br>

