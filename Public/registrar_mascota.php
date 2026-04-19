<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $tamano = $_POST["tamano"];
    $descripcion = $_POST["descripcion"];
    $caracteristicas = $_POST["caracteristicas"];
    $imagen = $_POST["imagen"];
    $enlace = $_POST["enlace"];

    $sql = "INSERT INTO mascotas (nombre, edad, descripcion, tamaño, caracteristicas, imagen, enlace_adopcion)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $nombre, $edad, $descripcion, $tamano, $caracteristicas, $imagen, $enlace);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Mascota registrada correctamente.</div>";
        echo "<div class='text-center'><a href='adoptar1.html' class='btn btn-primary'>Volver a Adoptar</a></div>";
    } else {
        echo "<div class='alert alert-danger'>Error al guardar: " . $conn->error . "</div>";
    }
} else {
    echo "<div class='alert alert-warning'>Acceso inválido. Use el formulario para registrar una mascota.</div>";
}
?>
