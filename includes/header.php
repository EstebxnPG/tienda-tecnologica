<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 

include 'conexion.php';

$sql = "SELECT * FROM categorias"; // cuidado si se llama 'Categorias' con mayúscula o minúscula
$resultado = $conn->query($sql);

if(!$resultado){
    die("Error en la consulta: " . $conn->error);
}
?> 
<!DOCTYPE html>
<html>
<head>
    <link href="../css/style_desplegable_login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <div class="menu logo-nav">
            <a href="../../index.php" class="logo">THETECMENS</a>
            <label class="menu-icon"><span class="fas fa-bars icomin"></span></label>
            <nav class="navigation">
                <ul>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li class="search-icon">
                        <input type="search" placeholder="Search">
                        <label class="icon">
                            <span class="fas fa-search"></span>
                        </label>
                    </li>
                    <li class="car">
                        <a href="carrito.html">
                            <svg class="bi bi-cart3" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <header>
        <div class="menu logo-nav">
            <a href="/tienda-tecnologica/index.php" class="logo">THETECMENS</a>
            <label class="menu-icon"><span class="fas fa-bars icomin"></span></label>
            <nav class="navigation">
                <ul>
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li class="dropdown">
                        <button class="dropdown-toggle">
                            Categorías ⌄
                        </button>
                        <div class="dropdown-menu">
                            <?php 
                            if($resultado->num_rows > 0){
                                while($fila = $resultado->fetch_assoc()){ 
                            ?>
                                <a href="#"><?php echo $fila['nombre']; ?></a>
                            <?php 
                                }
                            } else {
                                echo "<a>No hay categorías</a>";
                            }
                            ?>
                        </div>
                    </li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <li class="search-icon">
                        <input type="search" placeholder="Search">
                        <label class="icon">
                            <span class="fas fa-search"></span>
                        </label>
                    </li>
                    <li class="car">
                        <a href="carrito.html">
                            <svg class="bi bi-cart3" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="auth-buttons">
                        <?php if (isset($_SESSION['nombre'])): ?>
                            <div class="dropdown">
                                <button class="dropdown-toggle">
                                    <?php echo htmlspecialchars($_SESSION['nombre']); ?> ⌄
                                </button>
                                <div class="dropdown-menu">
                                    <?php if ($_SESSION['rol'] == 'super'): ?>
                                        <!-- Menu del Super Administrador -->
                                        <a href="#">Gestionar Usuarios</a>
                                        <a href="#">Gestionar Pedidos</a>
                                        <a href="/tienda-tecnologica/categorias/categorias.php">Gestionar Categorias</a>
                                        <a href="/tienda-tecnologica/productos/crear_producto.php">Crear Productos</a>
                                        <a href="/tienda-tecnologica/Login/logout.php">Cerrar Sesión</a>
                                    <?php else: ?>
                                        <!-- Menu de Usuario Normal -->
                                        <a href="#">Historial de Pedidos</a>
                                        <a href="#">Mis Datos</a>
                                        <a href="/tienda-tecnologica/Login/logout.php">Cerrar Sesión</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?> 
                            <a href="/tienda-tecnologica/Login/login.php" class="btn login-btn">Login</a>
                            <a href="/tienda-tecnologica/register/registro.php" class="btn register-btn">Registro</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');

            toggle.addEventListener('click', (e) => {
                e.stopPropagation(); 
                menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
            });
        });

        window.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        });
    </script>
    
    <!-- Estilos por que no los pude linkear (DPG) -->
</body>
</html>