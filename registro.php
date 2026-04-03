<?php
session_start();
require_once __DIR__ . "/models/Usuario.php";

header("Content-Type: application/json");

$nombre   = $_POST["nombre"]   ?? "";
$email    = $_POST["email"]    ?? "";
$password = $_POST["password"] ?? "";
$confirm  = $_POST["confirm"]  ?? "";

if ($nombre == "" || $email == "" || $password == "") {
    echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
    exit;
}

if ($password !== $confirm) {
    echo json_encode(["ok" => false, "mensaje" => "Las contrasenas no coinciden."]);
    exit;
}

$model = new Usuario();
if ($model->registrar($nombre, $email, $password)) {
    echo json_encode(["ok" => true, "mensaje" => "Registro exitoso. Ahora inicia sesion."]);
} else {
    echo json_encode(["ok" => false, "mensaje" => "Error al registrar. El correo ya existe."]);
}