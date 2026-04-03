<?php
require_once __DIR__ . "/../config/Database.php";

class Donacion {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function guardarMonetaria($nombre, $monto, $fecha, $tipo_pago) {
        $sql = "INSERT INTO donaciones_monetarias (nombre, monto, fecha, tipo_pago) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdss", $nombre, $monto, $fecha, $tipo_pago);
        return $stmt->execute();
    }

    public function guardarOtro($nombre, $cantidad, $tipo_donacion, $fecha) {
        $sql = "INSERT INTO donaciones_otros (nombre, cantidad, tipo_donacion, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siss", $nombre, $cantidad, $tipo_donacion, $fecha);
        return $stmt->execute();
    }
}