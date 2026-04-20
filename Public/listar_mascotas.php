<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

$sql = "SELECT * FROM mascotas";
$resultado = $conn->query($sql);

while($fila = $resultado->fetch_assoc()) {

    echo '
    <div class="animal-card">
        <img src="'.$fila['imagen'].'">
        <div class="animal-card-body">
            <h2>'.$fila['nombre'].'</h2>
            <p>'.$fila['descripcion'].'</p>
        </div>
    </div>
    ';
}
?>