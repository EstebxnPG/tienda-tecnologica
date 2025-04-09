<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - THETECMENS</title>
    <link href="/tienda-tecnologica/assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    // Iniciar la sesión para mantener mensajes
    session_start();
    
    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tienda_sena";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Consulta para obtener las categorías
    $sql_categorias = "SELECT * FROM categorias";
    $categorias = $conn->query($sql_categorias);
    
    // Procesar el formulario cuando se envíe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger los datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $precio = floatval($_POST['precio']);
        $stock = intval($_POST['stock']);
        $categoria_id = intval($_POST['categoria_id']);
        $oferta = isset($_POST['oferta']) ? $_POST['oferta'] : 'no';
          $fecha = date('Y-m-d'); // Fecha actual
        
        // Procesar la imagen subida
        $imagen = "";
        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $target_dir = "uploads/images/";
            
            // Crear directorio si no existe
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            // Generar nombre único para la imagen
            $extension = pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION);
            $imagen = 'producto_' . time() . '.' . $extension;
            $target_file = $target_dir . $imagen;
            
            // Verificar si es una imagen real
            $check = getimagesize($_FILES["imagen"]["tmp_name"]);
            if($check !== false) {
                // Intentar subir el archivo
                if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                    // Archivo subido correctamente
                } else {
                    $_SESSION['error'] = "Error al subir la imagen.";
                    $imagen = "";
                }
            } else {
                $_SESSION['error'] = "El archivo no es una imagen válida.";
                $imagen = "";
            }
        }
        
        // Insertar datos en la base de datos
        $sql = "INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) 
                VALUES ($categoria_id, '$nombre', '$descripcion', $precio, $stock, '$oferta', '$fecha', '$imagen')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Producto creado correctamente.";
              // Redireccionar para evitar reenvío del formulario
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $conn->error;
        }
    }
    ?>

    <header>
    <div class="menu logo-nav">
        <a href="index.php" class="logo">THETECMENS</a>
        <label class="menu-icon"><span class="fas fa-bars icomin"></span></label>
        <nav class="navigation">
        <ul>
            <li><a href="nosotros.php">Nosotros</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="crear_producto.php">Crear Producto</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li class="search-icon">
            <input type="search" placeholder="Buscar">
            <label class="icon">
                <span class="fas fa-search"></span>
            </label>
            </li>
            <li class="car">
            <a href="carrito.php" title="Ir al carrito de compras">
                <span class="sr-only">Carrito de compras</span>
                <svg class="bi bi-cart3" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1h2a.5.5 0 0 1 .49.4L3.89 5H14a.5.5 0 0 1 .49.6l-1.5 7A.5.5 0 0 1 12.5 13h-10a.5.5 0 0 1-.49-.4L.61 3H.5a.5.5 0 0 1 0-1H2a.5.5 0 0 1 .5.5v.5H1.61l1.5 7H12.5l1.5-7H3.89L2.99 1.9A.5.5 0 0 1 2.5 1.5H.5z"/>
                </svg>
            </a>
        </li>          
        </ul>
        </nav>
    </div>
    </header>
    
    <main>
    <div class="container-carrito">
        <h2>Crear Nuevo Producto</h2>
        
        <?php
        // Mostrar mensajes de éxito o error
        if(isset($_SESSION['success'])) {
            echo '<div class="mensaje-exito">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        
        if(isset($_SESSION['error'])) {
            echo '<div class="mensaje-error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        
        <form id="crear-producto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
            <div class="contenido titulo">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del producto" required>
            </div>
            
            <div class="contenido titulo">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción detallada del producto" rows="4"></textarea>
            </div>
            
            <div class="contenido titulo">
                <label for="categoria_id">Categoría:</label>
                <select class="form-control" id="categoria_id" name="categoria_id" required>
                    <option value="">Seleccione una categoría</option>
                    <?php
                    // Mostrar las categorías desde la base de datos
                    if ($categorias->num_rows > 0) {
                        while($row = $categorias->fetch_assoc()) {
                            echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <div class="contenido titulo">
                <label for="precio">Precio (€):</label>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="0.00" step="0.01" min="0" required>
            </div>
            
            <div class="contenido titulo">
                <label for="stock">Stock Disponible:</label>
                <input type="number" class="form-control" id="stock" name="stock" placeholder="0" min="0" required>
            </div>
            
            <div class="contenido titulo checkbox-contenedor">
                <label for="oferta">¿Está en oferta?</label>
                <div class="opciones-oferta">
                    <label><input type="radio" name="oferta" value="si"> Sí</label>
                    <label><input type="radio" name="oferta" value="no" checked> No</label>
                </div>
            </div>
            
            <div class="contenido titulo">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                <p class="help-text">Formatos aceptados: JPG, PNG, GIF. Tamaño máximo: 2MB</p>
            </div>
        
            <div class="vista-previa" id="vista-previa">
                <img id="preview-imagen" src="#" alt="Vista previa" style="display: none; max-width: 200px; margin-top: 10px;">
            </div>

            <div id="loaders" style="display: none;">
                <img id="cargando" src="assets/img/cargando.gif" width="220" alt="Cargando..." title="Imagen de carga">
            </div>

            <div class="botones-envio">
                <a href="productos.php" class="button button-secundario">Cancelar</a>
                <input type="submit" class="button" id="guardar-producto" value="Guardar Producto">
            </div>
        </form>
    </div>
    </main>
    
    <?php include '../assets/includes/footer.php'; ?>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
    // Script para mostrar la vista previa de la imagen
    document.getElementById('imagen').addEventListener('change', function(e) {
        const preview = document.getElementById('preview-imagen');
        const file = e.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });
    
    // Script para validar el formulario antes de enviar
    document.getElementById('crear-producto').addEventListener('submit', function(e) {
        const nombre = document.getElementById('nombre').value;
        const precio = document.getElementById('precio').value;
        const stock = document.getElementById('stock').value;
        const categoria = document.getElementById('categoria_id').value;

        if (nombre.trim() === '' || precio <= 0 || stock < 0 || categoria === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error de validación',
                text: 'Por favor complete todos los campos obligatorios correctamente.'
            });
        } else {
            document.getElementById('loaders').style.display = 'block';
            // Mostrar mensaje de éxito
            Swal.fire({
                icon: 'info',
                title: 'Procesando...',
                text: 'Guardando producto, por favor espere.',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });

      // Navegación responsive
    $(document).ready(function() {
        $('.menu-icon').click(function() {
            $('nav ul').toggleClass('show');
        });
    });
    </script>
</body>
</html>