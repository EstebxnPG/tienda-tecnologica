
<div class="modal" id="modal">
          <div class="modal-content">
            <img src="" alt="" class="modal-img" id="modal-img">
          </div>
          <div class="modal-boton" id="modal-boton">X</div>
        </div>
        <h1 class="title-product">Mis Productos</h1>
        <div class="container-productos" id="lista-productos">
        <?php
          $conexion = new mysqli("localhost", "root", "", "tienda_sena");
          $conexion->set_charset("utf8");

          $sql = "SELECT * FROM productos";
          $resultado = $conexion->query($sql);

          if ($resultado->num_rows > 0) {
              while ($producto = $resultado->fetch_assoc()) {
                  echo '<div class="card">';
                  echo '  <img src="/tienda-tecnologica/productos/uploads/images/' . htmlspecialchars($producto['imagen']) . '" class="card-img">';
                  echo '  <h5>' . htmlspecialchars($producto['nombre']) . '</h5>';
                  echo '  <p>SKU: PROD' . str_pad($producto['id'], 7, "0", STR_PAD_LEFT) . '</p>';
                  echo '  <p>S/.<small class="precio">' . number_format($producto['precio'], 2) . '</small></p>';
                  echo '  <a href="#" class="button agregar-carrito" data-id="' . $producto['id'] . '">Comprar</a>';
                  echo '</div>';
              }
          } else {
              echo '<p>No hay productos registrados aún.</p>';
          }
          ?>
        </div>