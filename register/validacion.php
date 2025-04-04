<?php 
include 'conexion.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";
    } elseif (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT id FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>
            alert('!Falla en el registo! No se pudo completar.');
            window.location.href = '../register/registro.php';
          </script>";
    exit();
        } else {
            $stmt->close();

            $rol = "usuario";
            $imagen = "default.jpg";

            $query = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $nombre, $apellido, $email, $passwordHash, $rol, $imagen);

            if ($stmt->execute()) {
                // Mostrar alerta y redirigir con JavaScript
                echo "<script>
                        alert('¡Registro exitoso! Ahora puedes iniciar sesión');
                        window.location.href = '../login/login.php';
                      </script>";
                exit();
            } else {
                $mensaje = "Error al registrar el usuario.";
            }
        }
        $stmt->close();
    }

    $conn->close();
}

// Si hay errores, redirigir con mensaje a registro.php
if (!empty($mensaje)) {
    header("Location: registro.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>
