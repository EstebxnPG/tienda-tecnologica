<?php
// producto_detalle.php
include __DIR__ . '/../../config/conexion.php';

// Verificar si se recibió un ID de producto
if (!isset($_GET['id'])) {
    header('Location: main.php');
    exit();
}

$producto_id = intval($_GET['id']);

// Obtener los datos del producto
$sql = "SELECT * FROM productos WHERE id = $producto_id";
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    header('Location: main.php');
    exit();
}

$producto = $resultado->fetch_assoc();

// Cantidad de productos en el carrito (como en main.php)
$cantidadCarrito = 0;
if (isset($_SESSION['carrito'])) {
    $cantidadCarrito = array_sum($_SESSION['carrito']);
}
?>

<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
<?php include '../../includes/head.php'; ?>

<body>
<?php include '../../includes/header.php'; ?>

    <main>
        <!-- Modal para imágenes (igual que en main.php) -->
        <div class="modal" id="modal">
            <div class="modal-content">
                <img src="" alt="" class="modal-img" id="modal-img">
            </div>
            <div class="modal-boton" id="modal-boton">X</div>
        </div>

        <!-- Detalle del producto -->
        <div class="container">
            <div class="columna1">
                <img src="/tienda-tecnologica/components/productos/uploads/images/<?php echo htmlspecialchars($producto['imagen']); ?>" 
                     alt="<?php echo htmlspecialchars($producto['nombre']); ?>" 
                     class="card-img" 
                     style="width: 100%; max-width: 500px; height: auto; cursor: pointer;">
            </div>
            
            <div class="columna1" style="text-align: left; padding: 20px;">
                <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
                <p style="font-size: 1.2rem; color: #666; margin-bottom: 1.5rem;">SKU: PROD<?php echo str_pad($producto['id'], 7, "0", STR_PAD_LEFT); ?></p>
                
                <div style="margin-bottom: 2rem;">
                    <p style="font-size: 2rem; color: #DF691A; font-weight: bold;">
                        USD <?php echo number_format($producto['precio'], 2); ?>
                    </p>
                </div>
                
                <div style="margin-bottom: 2rem;">
                    <p style="font-size: 1.1rem; line-height: 1.6; color: #444;">
                        <?php echo nl2br(htmlspecialchars($producto['descripcion'] ?? 'Descripción no disponible')); ?>
                    </p>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <a href="/tienda-tecnologica/components/carrito/agregar_carrito.php?id=<?php echo $producto['id']; ?>" 
                       class="button" 
                       style="padding: 15px 30px; font-size: 1.1rem;">
                        Comprar ahora
                    </a>
                    <a href="/tienda-tecnologica/index.php" 
                       class="button-secundario" 
                       style="padding: 15px 30px; font-size: 1.1rem;">
                        Volver a productos
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer (similar al de tu página principal) -->
    <?php include '../../includes/footer.php'; ?>


    <!-- Script para el modal de imágenes -->
    <script>
        // Similar al que debes tener en main.php para el modal
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal');
            const modalImg = document.getElementById('modal-img');
            const modalBoton = document.getElementById('modal-boton');
            const imagenProducto = document.querySelector('.card-img');
            
            // Abrir modal al hacer clic en la imagen del producto
            if (imagenProducto) {
                imagenProducto.addEventListener('click', function() {
                    modal.classList.add('modal-open');
                    modalImg.src = this.src;
                });
            }
            
            // Cerrar modal
            modalBoton.addEventListener('click', function() {
                modal.classList.remove('modal-open');
            });
        });
    </script>
</body>
</html>