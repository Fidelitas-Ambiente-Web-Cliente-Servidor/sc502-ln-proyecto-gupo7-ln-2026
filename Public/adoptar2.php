<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

// 🔥 recibir ID del perro
$id = $_GET["id"] ?? 0;

// 🔥 buscar en BD
$sql = "SELECT * FROM mascotas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$mascota = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Adopción</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/adoptar2.css">
</head>

<body>

<div class="container mt-5">

    <?php if ($mascota) { ?>

        <h2>🐶 Adopción de: <?= $mascota["nombre"] ?></h2>

        <img src="<?= $mascota["imagen"] ?>" width="300" class="mb-3">

        <p><?= $mascota["descripcion"] ?></p>

        <hr>

        <h3>Formulario de adopción</h3>

        <form method="POST" action="guardar_adopcion.php">

            <input type="hidden" name="mascota_id" value="<?= $mascota["id"] ?>">

            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Fecha de visita</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <button class="btn btn-success">Enviar adopción</button>

        </form>

    <?php } else { ?>

        <h3>❌ Mascota no encontrada</h3>

    <?php } ?>

</div>

</body>
</html>