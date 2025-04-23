    <?php
    session_start();
    include __DIR__ . '/../../config/conexion.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($email) || empty($password)) {
            echo "<script>
            alert('¡Por favor completar todos los campos!');
            window.location.href = 'login.php';
            </script>";  
            exit();
        }

        if($email == 'admin@admin.com' && $password == 'contraseña'){
            $_SESSION['email'] = $email;
            $_SESSION['nombre'] = 'Super Administrador';
            $_SESSION['rol'] = 'super';

            echo "<script>
            alert('¡Bienvenido Super Administrador!');
            window.location.href = '../../index.php';
            </script>";  
            exit();
        }

        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['rol'] = 'usuario';
                $_SESSION['usuario_id'] = $row['id'];


                echo "<script>
                alert('¡Inicio Sesión Exitoso!');
                window.location.href = '../../index.php';
                </script>";   
                exit();
            } else {
                echo "<script>
                alert('Email o Contraseña Incorrectos!');
                window.location.href = 'login.php';
                </script>";  
            }
        } else {
            echo "<script>
            alert('Email o Contraseña Incorrectos!');
            window.location.href = 'login.php';
            </script>";  
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Acceso no permitido.";
    }
    ?>
