<?php
// Conexión a la base de datos (ajusta tus credenciales)
$dsn = "mysql:host=localhost;dbname=tienda_sena;charset=utf8mb4";
$usuario = "root";
$contrasena = "";

try {
    $pdo = new PDO($dsn, $usuario, $contrasena);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Actualizar estado del pedido si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_estado'])) {
    $idPedido = $_POST['id'];
    $nuevoEstado = $_POST['estado_nuevo'];

    $stmt = $pdo->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
    $stmt->execute([$nuevoEstado, $idPedido]);
}

// Filtros
$filtroEstado = $_GET['estado'] ?? '';
$busqueda = $_GET['buscar'] ?? '';

$sql = "SELECT * FROM pedidos WHERE 1=1";
$parametros = [];

if ($filtroEstado) {
    $sql .= " AND estado = ?";
    $parametros[] = $filtroEstado;
}
if ($busqueda) {
    $sql .= " AND (provincia LIKE ? OR localidad LIKE ? OR direccion LIKE ? OR id LIKE ?)";
    $parametros[] = "%$busqueda%";
    $parametros[] = "%$busqueda%";
    $parametros[] = "%$busqueda%";
    $parametros[] = "%$busqueda%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($parametros);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
    <link rel="stylesheet" href="../pedidos/css/pedidos.css"> <!-- cambia la ruta si es necesario -->
</head>
<body>
<?php include '../../includes/header.php'; ?>
<?php include '../../includes/head.php'; ?>
<div class="container">
    <h1>Gestión de Pedidos</h1>

    <form method="get" class="filters">
        <input type="text" name="buscar" placeholder="Buscar por provincia, dirección, etc..." value="<?= htmlspecialchars($busqueda) ?>">
        <select name="estado">
            <option value="">Todos los estados</option>
            <option value="Pendiente" <?= $filtroEstado === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
            <option value="En proceso" <?= $filtroEstado === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
            <option value="Enviado" <?= $filtroEstado === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
            <option value="Entregado" <?= $filtroEstado === 'Entregado' ? 'selected' : '' ?>>Entregado</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Dirección</th>
            <th>Coste</th>
            <th>Estado</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Actualizar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= htmlspecialchars($pedido['id']) ?></td>
                <td><?= htmlspecialchars($pedido['provincia']) ?></td>
                <td><?= htmlspecialchars($pedido['localidad']) ?></td>
                <td><?= htmlspecialchars($pedido['direccion']) ?></td>
                <td>$<?= number_format($pedido['coste'], 2) ?></td>
                <td><?= htmlspecialchars($pedido['estado']) ?></td>
                <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                <td><?= htmlspecialchars($pedido['hora']) ?></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $pedido['id'] ?>">
                        <select name="estado_nuevo">
                            <option value="Pendiente" <?= $pedido['estado'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                            <option value="En proceso" <?= $pedido['estado'] === 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                            <option value="Enviado" <?= $pedido['estado'] === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
                            <option value="Entregado" <?= $pedido['estado'] === 'Entregado' ? 'selected' : '' ?>>Entregado</option>
                        </select>
                        <button type="submit" name="cambiar_estado">Actualizar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($pedidos)): ?>
            <tr><td colspan="9">No se encontraron pedidos.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
