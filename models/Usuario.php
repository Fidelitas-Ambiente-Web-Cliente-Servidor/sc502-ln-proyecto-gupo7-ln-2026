<?php
require_once __DIR__ . "/../config/Database.php";

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function registrar($nombre, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre, $email, $hash);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        if ($resultado && password_verify($password, $resultado["password"])) {
            return $resultado;
        }
        return false;
    }
}