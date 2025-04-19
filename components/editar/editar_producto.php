<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../components/editar/style.css">
</head>
<body>

<?php
 include __DIR__ . '/../../config/conexion.php';
 include '../../includes/head.php'; 
 include '../../includes/header.php';
 include '../../includes/footer.php'; 
?>
<form class="form">
            <div class="titleContainer">
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
                </select>
            </div>
            
            <div class="contenido titulo">
                <label for="precio">Precio:</label>
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
</body>
</html>