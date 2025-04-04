<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Verificar si el formulario fue enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validaciones básicas
    if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
        die("Todos los campos son obligatorios.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El correo electrónico no es válido.");
    }

    if (strlen($password) < 6) {
        die("La contraseña debe tener al menos 6 caracteres.");
    }

    // Hash de la contraseña para mayor seguridad
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Verificar si el correo ya está registrado en la tabla `usuarios`
    $query = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Este correo ya está registrado.");
    }
    $stmt->close();

    // Valores predeterminados
    $rol = "usuario"; // Asignar "usuario" como rol por defecto
    $imagen = "default.jpg"; // Imagen por defecto

    // Insertar usuario en la tabla `usuarios`
    $query = "INSERT INTO usuarios (nombre, apellidos, email, password, rol, imagen) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $nombre, $apellido, $email, $passwordHash, $rol, $imagen);

    if ($stmt->execute()) {
        // Redirigir al login después del registro exitoso
        header("Location: ../login/login.php");
        exit();
    } else {
        echo "Error al registrar el usuario.";
    }

    $stmt->close();
    $conn->close();
} else {
    die("Acceso no autorizado.");
}
?>
