<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THETECMENS</title>
    <link rel="stylesheet" href="../Login/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <?php include '../../includes/head.php'; ?>
</head>
<body>
        <!-- Nav bar -->
    <?php include '../../includes/header.php'; ?>
    <div class="super__container">
        <div class="container">
            
            <div class="login__container">
                <img src="/STYLES_index_login/img/logo-sena.png" alt="" class="logo__container">
                <h2 class="title__container"> INICIA SESIÓN </h2>
                <p class="welcome__container"> Bienvenido a la tienda THETECMENS </p>
                <form class="form login__form" method="POST" action="procesar_login.php"">
                    <label class="form__label" for="email">Correo Electrónico</label>
                    <input type="email" class="form__input" id="email" name="email" placeholder="Ingresa tu correo" >
                    <br>
                    <label class="form__label" for="password">Contraseña</label>
                    <input type="password" class="form__input" id="password" name="password" placeholder="Ingresa tu contraseña">
                    <br>
                    <a href="/SGVA OLVIDO SU CONTRASEÑA/HTML Olvido contraseña/index2.html" class="forgot_password">¿Olvidaste tu contraseña?</a>
                
                    <button type="submit" class="login-button__form">INICIAR SESIÓN</button>
                </form>
            </div>

        </div>
    </div>

</body>
</html>