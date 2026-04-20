<?php
session_start();
require_once __DIR__ . "/models/Usuario.php";

header("Content-Type: application/json");

$email    = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";

if ($email == "" || $password == "") {
    echo json_encode(["ok" => false, "mensaje" => "Campos obligatorios"]);
    exit;
}

$model = new Usuario();
$usuario = $model->login($email, $password);

if ($usuario) {

   
    $_SESSION["sesionActiva"] = true;
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["rol"] = $usuario["rol"]; // 👑 IMPORTANTE

    echo json_encode([
        "ok" => true,
        "nombre" => $usuario["nombre"],
        "rol" => $usuario["rol"]
    ]);

} else {
    echo json_encode([
        "ok" => false,
        "mensaje" => "Correo o contraseña incorrectos"
    ]);
}