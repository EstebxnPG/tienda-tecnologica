<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THETECMENS</title>
    <link rel="stylesheet" href="../Login/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- head -->
    <?php include '../../includes/head.php'; ?>
    
</head>
<body>
    
    <!-- Nav bar -->
    <?php include '../../includes/header.php'; ?>

    <div class="super__container">
        <div class="container">
            <div class="login__container">
                <img src="/STYLES_index_login/img/logo-sena.png" alt="" class="logo__container">
                <h2 class="title__container"> REGISTRAR </h2>
                <p class="welcome__container"> Bienvenido a la tienda THETECMENS </p>
                <form class="form login__form"action="validacion.php" method="POST">
                    
                    <label class="form__label" for="nombre">Nombre</label>
                    <input type="text" class="form__input" name="nombre" placeholder="Ingresa tu nombre" >
                    <br>
                    <label class="form__label" for="apellido">Apellido</label>
                    <input type="text" class="form__input" name="apellido" placeholder="Ingresa tu apellido">
                    <br>
                    <label class="form__label" for="email">Correo Electrónico</label>
                    <input type="email" class="form__input" name="email" placeholder="Ingresa tu correo" >
                    <br>
                    <label class="form__label" for="password">Contraseña</label>
                    <input type="password" class="form__input" name="password" placeholder="Ingresa tu contraseña" required>
                    <br>
                    <button type="submit" class="login-button__form">REGISTRARSE</button>
                </form>
            </div>

        </div>
    </div>  

</body>

</html>