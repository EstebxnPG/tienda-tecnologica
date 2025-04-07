<?php

session_start();
session_unset();  // Limpia las variables de sesión
session_destroy(); // Destruye la sesión

echo "<script>
alert('¡Cierre de Sesión Exitoso!');
window.location.href = '../login/login.php';
</script>";
exit();
?>
