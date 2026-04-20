<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

$mensaje = "";
$tipo = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $descripcion = $_POST["descripcion"];

    $nombreImagen = $_FILES["imagen"]["name"];
    $rutaTemporal = $_FILES["imagen"]["tmp_name"];

    $rutaDestino = "imagenes/" . $nombreImagen;
    
    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {

        $sql = "INSERT INTO mascotas (nombre, edad, descripcion, tamano, imagen)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("sisss", $nombre, $edad, $descripcion, $tamano, $rutaDestino);

            if ($stmt->execute()) {
                $mensaje = "Mascota registrada correctamente 🐶";
                $tipo = "success";
            } else {
                $mensaje = "Error BD: " . $stmt->error;
                $tipo = "danger";
            }

        } else {
            $mensaje = "Error en consulta: " . $conn->error;
            $tipo = "danger";
        }

    } else {
        $mensaje = "Error al subir la imagen";
        $tipo = "danger";
    }

} else {
    $mensaje = "Acceso inválido";
    $tipo = "warning";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Resultado</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/resultado.css">

</head>

<body>

<div class="resultado-box">
    <h2 class="text-<?php echo $tipo; ?>">
        <?php echo $mensaje; ?>
    </h2>

    <a href="registrar_mascota.html" class="btn btn-primary mt-3">
        Volver
    </a>
</div>

</body>
</html>