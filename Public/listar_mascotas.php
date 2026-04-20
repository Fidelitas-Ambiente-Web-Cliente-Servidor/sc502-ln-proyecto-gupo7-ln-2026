<?php
require_once __DIR__ . "/../config/Database.php";

$db = new Database();
$conn = $db->connect();

// 🔍 recibir búsqueda por nombre
$nombre = $_GET["nombre"] ?? "";

// 🔥 si escribió algo, filtra
if ($nombre != "") {

    $sql = "SELECT * FROM mascotas WHERE nombre LIKE ?";
    $stmt = $conn->prepare($sql);

    $busqueda = "%" . $nombre . "%";
    $stmt->bind_param("s", $busqueda);
    $stmt->execute();
    $resultado = $stmt->get_result();

} else {
    // 🔄 si no busca nada, trae todo
    $sql = "SELECT * FROM mascotas";
    $resultado = $conn->query($sql);
}

// 🔥 mostrar tarjetas
while($fila = $resultado->fetch_assoc()) {

    echo '
    <a href="adoptar2.html" class="text-decoration-none">
           <div class="animal-card">
               <img src="'.$fila['imagen'].'">
               <div class="animal-card-body">
                  <h2>'.$fila['nombre'].'</h2>
                  <p>'.$fila['descripcion'].'</p>
                </div>
           </div>
           </a>
';

}
?>