<?php
// Simulación de pedidos
$pedidos = [
    ["id" => "PED-001", "cliente" => "Juan Pérez", "fecha" => "2025-04-09", "total" => "$1500", "estado" => "Pendiente"],
    ["id" => "PED-002", "cliente" => "Ana Gómez", "fecha" => "2025-04-08", "total" => "$3200", "estado" => "Enviado"],
    ["id" => "PED-003", "cliente" => "Carlos Ruiz", "fecha" => "2025-04-07", "total" => "$2800", "estado" => "Entregado"],
];

// Filtro básico
$filtroEstado = $_GET['estado'] ?? '';
$busqueda = $_GET['buscar'] ?? '';

$pedidosFiltrados = array_filter($pedidos, function ($pedido) use ($filtroEstado, $busqueda) {
    $coincideEstado = $filtroEstado ? $pedido['estado'] === $filtroEstado : true;
    $coincideBusqueda = $busqueda ? (stripos($pedido['cliente'], $busqueda) !== false || stripos($pedido['id'], $busqueda) !== false) : true;
    return $coincideEstado && $coincideBusqueda;
});
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pedidos</title>
    <link rel="stylesheet" href="../pedidos/css/pedidos.css">
</head>
<body>
    <div class="container">
    <h1>Gestión de Pedidos</h1>

    <form method="get" class="filters">
    <input type="text" name="buscar" placeholder="Buscar por cliente o ID..." value="<?= htmlspecialchars($busqueda) ?>">
    <select name="estado">
        <option value="">Todos los estados</option>
        <option value="Pendiente" <?= $filtroEstado === 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
        <option value="Enviado" <?= $filtroEstado === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
        <option value="Entregado" <?= $filtroEstado === 'Entregado' ? 'selected' : '' ?>>Entregado</option>
    </select>
    <button type="submit">Filtrar</button>
    </form>

    <table>
    <thead>
        <tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Fecha</th>
    <th>Total</th>
    <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pedidosFiltrados as $pedido): ?>
        <tr>
            <td><?= $pedido['id'] ?></td>
            <td><?= $pedido['cliente'] ?></td>
            <td><?= $pedido['fecha'] ?></td>
            <td><?= $pedido['total'] ?></td>
            <td><?= $pedido['estado'] ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($pedidosFiltrados)): ?>
        <tr>
            <td colspan="5">No se encontraron pedidos.</td>
        </tr>
        <?php endif; ?>
    </tbody>
    </table>
</div>
</body>
</html>
