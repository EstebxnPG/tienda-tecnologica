<?php
include __DIR__ . '/../../config/conexion.php';
include '../../includes/header.php'; 
include '../../includes/validador.php';



// Obtener el ID de la categoría desde la URL
$categoria_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Consulta para obtener los productos de la categoría con JOIN para el nombre de categoría
$sql = "SELECT p.*, c.nombre AS categoria_nombre 
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        WHERE p.categoria_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $categoria_id);
$stmt->execute();
$resultado = $stmt->get_result();

// Obtener información de la categoría
$categoria = $resultado->fetch_assoc(); // Solo si hay productos
if (!$categoria) {
    // Si no hay productos, obtener solo el nombre de la categoría
    $sql_cat = "SELECT nombre FROM categorias WHERE id = ?";
    $stmt_cat = $conn->prepare($sql_cat);
    $stmt_cat->bind_param("i", $categoria_id);
    $stmt_cat->execute();
    $categoria = $stmt_cat->get_result()->fetch_assoc();
}

// Incluir el header
include '../../includes/head.php'; ?>


<div class="modal" id="modal">
    <div class="modal-content">
        <img src="" alt="" class="modal-img" id="modal-img">
    </div>
    <div class="modal-boton" id="modal-boton">X</div>
</div>

<h1 class="title-product">Productos de <?php echo htmlspecialchars($categoria['categoria_nombre'] ?? $categoria['nombre']); ?></h1>

<div class="container-productos" id="lista-productos">
    <?php if($resultado->num_rows > 0): ?>
        <?php 
        // Reiniciar el puntero del resultado si lo usamos antes
        if(isset($categoria['categoria_nombre'])) {
            $resultado->data_seek(0);
        }
        while($producto = $resultado->fetch_assoc()): ?>
            <div class="card">
                <img src="/tienda-tecnologica/components/productos/uploads/images/<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img">
                <h5><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                <p>SKU: PROD<?php echo str_pad($producto['id'], 7, "0", STR_PAD_LEFT); ?></p>
                <p>(USD)<small class="precio"><?php echo number_format($producto['precio'], 2); ?></small></p>
                <a href="/tienda-tecnologica/components/productos/producto_detalle.php?id=<?php echo $producto['id']; ?>" class="button-detalles">Ver Detalles</a>
                <a href="/tienda-tecnologica/components/carrito/agregar_carrito.php?id=<?php echo $producto['id']; ?>" class="button">Comprar</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay productos en esta categoría.</p>
    <?php endif; ?>
</div>

<?php
// Incluir el footer
include '../../includes/footer.php'; ?>
