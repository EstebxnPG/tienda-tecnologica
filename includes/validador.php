<?php
session_start();

// Verifica si hay sesión iniciada y si el rol es "super"
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'super') {
    echo "<script>
    alert('Acceso denegado.');
    window.location.href = '../index.php';
    </script>";
    exit();
}
?>
