<?php
session_start();
include '../register/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validar que no estén vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor completa todos los campos.";
        exit();
    }

    // Buscar usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Validar contraseña hasheada
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            echo "<script>
            alert('¡Inicio Sesión Exitoso! Ahora puedes navegar.');
            window.location.href = '../index.php';
          </script>";   
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El correo no está registrado.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no permitido.";
}
?>
