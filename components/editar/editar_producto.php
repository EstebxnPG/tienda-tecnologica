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
?>
<form class="form">
            <div class="title">
                <label for="titulo" class="title-h1"> Edita tu Producto</label>
            </div>
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
                <input type="text" class="form-control" id="precio" name="precio" placeholder="0.00" required>
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
<style>

body {      
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 100px;
    font-family: 'Arial', sans-serif;
    background-color: #fff;
    color: #000;
}

main {
    display: flex;
    justify-content: center;
    padding: 40px 20px;
}

.form {
    max-width: 600px;
    width: 100%;
    background-color: #fff;
}

.title{
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center;
}

.title-h1{
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 20px;
}

.titleContainer h1 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 30px;
}

.contenido,
.titleContainer,
.checkbox-contenedor,
.botones-envio {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    font-size: 16px;
}

.form-control {
    padding: 10px 12px;
    font-size: 15px;
    border: 1px solid #f48221;
    border-radius: 8px;
    outline: none;
}

textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

.checkbox-contenedor .opciones-oferta {
    display: flex;
    gap: 20px;
    margin-top: 10px;
}

.help-text {
    font-size: 13px;
    color: #888;
    margin-top: 5px;
}

.vista-previa img {
    display: block;
    max-width: 200px;
    margin-top: 10px;
    border-radius: 6px;
}

.botones-envio {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
}

.button {
    padding: 10px 20px;
    background-color: #f48221;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-decoration: none;
    text-align: center;
}

.button:hover {
    background-color: #d56f1b;
}

.button-secundario {
    background-color: #ccc;
    color: #000;
}

.button-secundario:hover {
    background-color: #bbb;
}

@media (max-width: 600px) {
    main {
        padding: 20px 10px;
    }

    .form {
        max-width: 100%;
    }

    .botones-envio {
        flex-direction: column;
        align-items: stretch;
    }

    .button,
    .button-secundario {
        width: 100%;
    }
}
</style>
</body>
</html>