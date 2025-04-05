<?php
session_start();
session_destroy();
header("Location: ../index.php"); // o a donde quieras redirigir
exit();
?>
