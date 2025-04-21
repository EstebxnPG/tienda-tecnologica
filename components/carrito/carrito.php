<script>
    // Función para actualizar el subtotal y el total global
    function actualizarTotales() {
        let subtotal = 0;
        let filas = document.querySelectorAll("#lista-compra tbody tr");

        // Iterar por cada fila del carrito
        filas.forEach(function(fila) {
            const cantidadInput = fila.querySelector("input[name^='cantidad']");
            const precio = parseFloat(fila.querySelector("td:nth-child(3)").innerText.replace(" USD", ""));
            const cantidad = parseInt(cantidadInput.value);
            const subtotalProducto = precio * cantidad;

            // Actualizar el subtotal por producto en la tabla
            fila.querySelector(".subtotal").innerText = subtotalProducto.toFixed(2) + " USD";

            // Sumar al subtotal global
            subtotal += subtotalProducto;
        });

        // Actualizar los totales globales
        const igv = subtotal * 0.18;
        const total = subtotal + igv;

        // Mostrar los resultados
        document.querySelector("#subtotal").innerText = subtotal.toFixed(2) + " USD";
        document.querySelector("#igv").innerText = igv.toFixed(2) + " USD";
        document.querySelector("#total").innerText = total.toFixed(2) + " USD";
    }

    // Asignar evento a los inputs de cantidad
    document.addEventListener("DOMContentLoaded", function() {
        const cantidadInputs = document.querySelectorAll("input[name^='cantidad']");
        cantidadInputs.forEach(function(input) {
            input.addEventListener("input", actualizarTotales);
        });

        // Inicializar los totales cuando la página cargue
        actualizarTotales();
    });
</script>



<?php
session_start();
include __DIR__ . '/../../config/conexion.php';
include '../../includes/head.php'; 
include '../../includes/header.php'; 


if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$subtotal = 0;
$igv = 0;
$total = 0;

$productos = [];
foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
    $consulta = "SELECT * FROM productos WHERE id= ?";
    $stmt = $conn->prepare($consulta); 
    $stmt->bind_param("i", $producto_id); 
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    
    if ($producto) {
        $producto['cantidad'] = $cantidad;
        $productos[] = $producto;
        
        $precio = floatval($producto['precio']);  // Convierte a número flotante
        $cantidad = intval($cantidad);  // Convierte a número entero

        $subtotal += $precio * $cantidad;

    }
}

$igv = $subtotal * 0.18; 
$total = $subtotal + $igv;
?>


<main>
    <div class="container-carrito">
        <h2>Realizar Compra</h2>
        <form id="procesar-pago" action="procesar_compra.php" method="POST">
    <div class="contenido titulo">
        <label for="cliente" class="">Cliente :</label>
        <input type="text" class="form-control" id="cliente" name="cliente" placeholder="Ingrese su nombre" onkeypress="return sololetras(event)" onpaste="return false" required>
    </div>
    <div class="contenido titulo">
        <label for="numero" class="">Número :</label>
        <input type="number" class="form-control" id="numero" name="numero" placeholder="Ingrese su número" required>
    </div>
    <div class="contenido titulo">
        <label for="direccion" class="">Dirección :</label>
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese su dirección" required>
    </div>
    <div class="contenido titulo">
        <label for="correo" class="">Correo :</label>
        <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo" required>
    </div>
    <div class="contenido titulo">
        <label for="metodo_pago" class="">Método de pago :</label>
        <select class="form-control" id="metodo_pago" name="metodo_pago" required>
            <option value="tarjeta">Tarjeta de Crédito</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia Bancaria</option>
        </select>
    </div>

    <div id="carrito" class="contenido">
        <table class="tabla" id="lista-compra">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($productos as $producto): ?>
                  <tr>
                      <td><img src="<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>" width="50"></td>
                      <td><?= $producto['nombre'] ?></td>
                      <td>
                          <?= number_format($producto['precio'], 2) ?> USD
                        
                          <input type="hidden" name="precio[<?= $producto['id'] ?>]" value="<?= $producto['precio'] ?>">
                      </td>
                      <td>
                          <input type="number" name="cantidad[<?= $producto['id'] ?>]" value="<?= $producto['cantidad'] ?>" min="1" class="cantidad" data-precio="<?= $producto['precio'] ?>" data-id="<?= $producto['id'] ?>" required>
                      </td>
                      <td class="subtotal" data-precio="<?= $producto['precio'] ?>" data-cantidad="<?= $producto['cantidad'] ?>">
                          <?= number_format($producto['precio'] * $producto['cantidad'], 2) ?> USD
                      </td>
                      <td><a href="eliminar_producto.php?id=<?= $producto['id'] ?>">Eliminar</a></td>
                  </tr>
              <?php endforeach; ?>
              </tbody>

            <tr>
                <th colspan="4">SUB TOTAL :</th>
                <th id="subtotal"><?= number_format($subtotal, 2) ?> USD</th>
            </tr>
            <tr>
                <th colspan="4">IGV (18%) :</th>
                <th id="igv"><?= number_format($igv, 2) ?> USD</th>
            </tr>
            <tr>
                <th colspan="4">TOTAL :</th>
                <th id="total"><?= number_format($total, 2) ?> USD</th>
            </tr>
        </table>
    </div>

    <!-- Campos ocultos para enviar los datos del total -->
    <input type="hidden" name="coste" id="coste" value="<?= $total ?>">

    <div class="botones-envio">
        <a href="/tienda-tecnologica/index.php" class="button" id="volver">Seguir comprando</a>
        <input type="submit" class="button" id="procesar-compra" value="Realizar compra">
    </div>
</form>

    </div>
</main>

</body>
</html>
