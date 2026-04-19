<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

$sql_monetarias = "SELECT id, nombre, monto, fecha, tipo_pago FROM donaciones_monetarias ORDER BY fecha DESC";
$result_monetarias = $conn->query($sql_monetarias);

$sql_otros = "SELECT id, nombre, cantidad, tipo_donacion, fecha FROM donaciones_otros ORDER BY fecha DESC";
$result_otros = $conn->query($sql_otros);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Donaciones | Vida Rescate</title>
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
  <h2>Lista de Donaciones</h2>
  <p>Registro actualizado de aportes monetarios y en especie</p>
</div>

<div class="container mt-4">
  <h3>Donaciones Monetarias</h3>
  <table class="table table-striped shadow">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Nombre Donante</th>
        <th>Monto</th>
        <th>Fecha</th>
        <th>Tipo de Pago</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result_monetarias->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= number_format($row["monto"], 2) ?></td>
          <td><?= $row["fecha"] ?></td>
          <td><?= htmlspecialchars($row["tipo_pago"]) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>




  <h3 class="mt-5">Donaciones otros</h3>
  <table class="table table-striped shadow">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Nombre Donante</th>
        <th>Cantidad</th>
        <th>Tipo de Donación</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result_otros->fetch_assoc()): ?>
        <tr>
          <td><?= $row["id"] ?></td>
          <td><?= htmlspecialchars($row["nombre"]) ?></td>
          <td><?= $row["cantidad"] ?></td>
          <td><?= htmlspecialchars($row["tipo_donacion"]) ?></td>
          <td><?= $row["fecha"] ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
