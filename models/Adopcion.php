<?php
require_once __DIR__ . "/../config/Database.php";

class Adopcion {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function guardar($nombre, $mascota, $fecha) {
        $sql = "INSERT INTO adopciones (nombre, mascota, fecha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $mascota, $fecha);
        return $stmt->execute();
    }
}