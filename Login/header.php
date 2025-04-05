<?php session_start(); ?>
<nav>
    <!-- Tu navbar aquí -->

    <div class="navbar-right">
        <?php if (isset($_SESSION['usuario'])): ?>
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></span>
            <a href="/Login/logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="/Login/login.php">Iniciar Sesión</a>
            <a href="/Login/registro.php">Registrarse</a>
        <?php endif; ?>
    </div>
</nav>
