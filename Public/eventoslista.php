<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, titulo, descripcion, fecha 
        FROM eventos 
        ORDER BY id DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eventos | Vida Rescate</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f0f4f8;
        font-family: 'Segoe UI', sans-serif;
    }

    .titulo {
        text-align: center;
        margin: 120px auto 40px;
    }

    .titulo h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #8e44ad;
    }

    .titulo p {
        color: #888;
        font-size: 1.1rem;
    }

    .tabla-container {
        max-width: 1100px;
        margin: auto;
        padding: 0 20px 60px;
    }
</style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
<div class="container">
    <a class="navbar-brand">Vida Rescate Atenas</a>
    <div>
        <a href="principal.html" class="btn btn-secondary me-2">⬅ Volver</a>
        <button class="btn btn-danger" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>
</div>
</nav>

<div class="titulo">
    <h2>📅 Lista de Eventos</h2>
    <p>Registro de actividades y campañas</p>
</div>

<div class="tabla-container">

<table class="table table-striped table-hover shadow bg-white">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Fecha</th>
        </tr>
    </thead>

    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= htmlspecialchars($row["titulo"]) ?></td>
                    <td><?= htmlspecialchars($row["descripcion"]) ?></td>
                    <td><?= $row["fecha"] ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">No hay eventos registrados</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</div>

<script>
function cerrarSesion() {
    window.location.href = "../logout.php";
}
</script>

</body>
</html>