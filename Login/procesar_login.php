<?php
session_start();
include '../register/conexion.php'; // asegúrate que aquí esté bien definido $conexion

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Si usas password_hash en el registro, cambia esta línea:
        // if (password_verify($password, $usuario['password'])) {
        if ($password === $usuario['password']) {
            $_SESSION['usuario'] = $usuario['nombre']; // o 'email' si prefieres
            header("Location: ../index.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "No se encontró el usuario";
    }
}
?>
