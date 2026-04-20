<?php
require_once __DIR__ . "/../config/Database.php";
$db = new Database();
$conn = $db->connect();

$nombre     = $_POST["nombre"]     ?? '';
$mascota_id = $_POST["mascota_id"] ?? 0;
$fecha      = $_POST["fecha"]      ?? '';

$sql = "SELECT nombre FROM mascotas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $mascota_id);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$mascota_nombre = $row["nombre"] ?? '';

$sql = "INSERT INTO adopciones (nombre, mascota, fecha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nombre, $mascota_nombre, $fecha);

$exito = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Adopción registrada</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/guardar_adopcion.css"> 
</head>
<body>

  <div class="result-card">

    <div class="card-top">
      <h1>🐾 Adopción</h1>
      <p class="subtitle">Registro de solicitud</p>
    </div>

    <div class="card-body">

      <?php if ($exito) { ?>

        <div class="result-icon success">✔</div>

        <div class="result-message">
          <h2>¡Solicitud enviada!</h2>
          <p>Tu adopción fue registrada correctamente.</p>
        </div>

        <div class="adoption-details">
          <div class="detail-row">
            <span class="label">Adoptante</span>
            <span class="value"><?= htmlspecialchars($nombre) ?></span>
          </div>
          <div class="detail-row">
            <span class="label">Mascota</span>
            <span class="value"><?= htmlspecialchars($mascota_nombre) ?></span>
          </div>
          <div class="detail-row">
            <span class="label">Fecha de visita</span>
            <span class="value"><?= htmlspecialchars($fecha) ?></span>
          </div>
        </div>

        <div class="result-actions">
          <a href="adoptar1.html" class="btn-primary-dark">Ver más mascotas</a>
          <a href="principal.html"    class="btn-outline-dark">Inicio</a>
        </div>

      <?php } else { ?>

        <div class="result-icon error">✖</div>

        <div class="result-message">
          <h2>Algo salió mal</h2>
          <p>No se pudo registrar la adopción. Intenta de nuevo.</p>
        </div>

        <div class="result-actions">
          <a href="javascript:history.back()" class="btn-primary-dark">Volver</a>
        </div>

      <?php } ?>

    </div>
  </div>

</body>
</html>