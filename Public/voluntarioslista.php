<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

$sql = "SELECT id, nombre, telefono, correo, tipo_voluntariado FROM voluntarios ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Voluntarios | Vida Rescate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        background-color: #f0f4f8;
        font-family: 'Segoe UI', sans-serif;
    }
    .titulo {
        text-align: center;
        margin: 120px auto 40px;
        color: #333;
    }
    .titulo h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #2c3e50;
    }
    .titulo p {
        color: #888;
        font-size: 1.1rem;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand">Vida Rescate Atenas</a>
    <div>
      <a href="estadisticas.html" class="btn btn-secondary me-2">⬅ Volver</a>
      <button class="btn btn-danger" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>
  </div>
</nav>

<div class="titulo">
  <h2>Lista de Voluntarios</h2>
  <p>Registro actualizado de personas inscritas</p>
</div>

<div class="container mt-4">
  <table class="table table-striped shadow">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Tipo de Voluntariado</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= htmlspecialchars($row["telefono"]) ?></td>
          <td><?= htmlspecialchars($row["correo"]) ?></td>
          <td><?= htmlspecialchars($row["tipo_voluntariado"]) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
