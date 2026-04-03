<?php
require_once __DIR__ . "/../config/Database.php";

class Evento {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function guardar($titulo, $descripcion, $fecha) {
        $sql = "INSERT INTO eventos (titulo, descripcion, fecha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $titulo, $descripcion, $fecha);
        return $stmt->execute();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM eventos ORDER BY fecha DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}