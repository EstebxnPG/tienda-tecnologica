<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contacto</title>
  <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

  <?php include '../tienda-tecnologica/assets/includes/head.php'; ?>
  <?php include '../tienda-tecnologica/assets/includes/header.php'; ?>
  
  <div class="container-contacto">
  <form action="#" id="form" method="POST">
    <h2>CONTACTO</h2>
    <br>
    <input type="text" name="cliente" id="nombre" placeholder="Ingrese su Nombre" onkeypress="return sololetras(event)" onpaste="return false" required>
    <input type="text" name="correo" id="correo" placeholder="Ingrese su Correo" required>
    <input type="text" name="celular" id="celular" placeholder="Ingrese su Celular" onkeypress="return solonumeros(event)" onpaste="return false" required>
    <textarea name="mensaje" placeholder="Escriba su Mensaje" required></textarea>
    <input type="submit" id="button-contacto" value="ENVIAR" class="button" onclick="validarCorreo(form.correo.value)">
  </form>
  </div>

    <?php include '../tienda-tecnologica/assets/includes/footer.php'; ?>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script  src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@2/dist/email.min.js"></script>
    <script  src="assets/js/scripts.js"></script>
    <script  src="assets/js/contacto.js"></script>
    <script src="assets/js/config.js"></script> <!-- Incluye el archivo de configuración -->
</body>
</html>