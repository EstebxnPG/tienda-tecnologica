<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'super') {
    echo "<script>
    alert('Acceso denegado.');
    window.location.href = '../../index.php';
    </script>";
    exit();
}
?>
