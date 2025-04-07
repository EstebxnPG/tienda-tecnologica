<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
?> 
    <link href="../css/style_desplegable_login.css" rel="stylesheet" type="text/css">
<body>
    <header>
      <div class="menu logo-nav">
        <a href="../../index.php" class="logo">THETECMENS</a>
        <label class="menu-icon"><span class="fas fa-bars icomin"></span></label>
        <nav class="navigation">
          <ul>
            <li><a href="nosotros.html">Nosotros</a></li>
            <li><a href="productos.html">Productos</a></li>
            <li><a href="contacto.html">Contacto</a></li>
            <li class="search-icon">
              <input type="search" placeholder="Search">
              <label class="icon">
                <span class="fas fa-search"></span>
              </label>
            </li>
            <li class="car"><a href="carrito.html" >
              <svg class="bi bi-cart3" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
              </svg></a>
              
            </li>
            <header>
              <div class="menu logo-nav">
                <a href="/tienda-tecnologica/index.php" class="logo">THETECMENS</a>
                <label class="menu-icon"><span class="fas fa-bars icomin"></span></label>
                <nav class="navigation">
                  <ul>
                    <li><a href="nosotros.html">Nosotros</a></li>
                    <li><a href="productos.html">Categorias</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
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
    <?php if (isset($_SESSION['email'])): ?>
        <div class="dropdown">
            <button class="dropdown-toggle">
                <?php echo htmlspecialchars($_SESSION['email']); ?> ⌄
            </button>
            <div class="dropdown-menu">
                <a href="/tienda-tecnologica/historial_pedidos.php">Historial de Pedidos</a>
                <a href="/tienda-tecnologica/Login/logout.php">Cerrar Sesión</a>
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
          </ul>
        </nav>
      </div>
    </header>
    
    <script>

const toggle = document.querySelector('.dropdown-toggle');
const menu = document.querySelector('.dropdown-menu');

toggle.addEventListener('click', () => {
menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});

// Opcional: Cierra el menú si clickea afuera
window.addEventListener('click', (e) => {
if (!e.target.matches('.dropdown-toggle')) {
menu.style.display = 'none';
}
});
</script>

<!-- Estilos por que no los pude linkear  (DPG) -->
 