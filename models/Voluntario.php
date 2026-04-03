<?php
require_once __DIR__ . "/../config/Database.php";

class Voluntario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function guardar($nombre, $telefono, $correo, $tipo_voluntariado) {
        $sql = "INSERT INTO voluntarios (nombre, telefono, correo, tipo_voluntariado) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $nombre, $telefono, $correo, $tipo_voluntariado);
        return $stmt->execute();
    }
}