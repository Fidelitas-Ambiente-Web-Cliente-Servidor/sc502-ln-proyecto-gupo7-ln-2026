<?php
session_start();
header("Content-Type: application/json");

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/Usuario.php';
require_once __DIR__ . '/models/Adopcion.php';
require_once __DIR__ . '/models/Donacion.php';
require_once __DIR__ . '/models/Voluntario.php';
require_once __DIR__ . '/models/Evento.php';
require_once __DIR__ . '/controllers/AdopcionController.php';
require_once __DIR__ . '/controllers/DonacionController.php';
require_once __DIR__ . '/controllers/VoluntarioController.php';
require_once __DIR__ . '/controllers/EventoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $option = $_POST['option'] ?? "";

    if ($option == "registro") {
        $nombre   = $_POST["nombre"]   ?? "";
        $email    = $_POST["email"]    ?? "";
        $password = $_POST["password"] ?? "";
        $confirm  = $_POST["confirm"]  ?? "";

        if ($password !== $confirm) {
            echo json_encode(["response" => "01", "message" => "Las contrasenas no coinciden."]);
            exit;
        }

        $model = new Usuario();
        if ($model->registrar($nombre, $email, $password)) {
            echo json_encode(["response" => "00", "message" => "Registro exitoso. Ahora inicia sesion."]);
        } else {
            echo json_encode(["response" => "01", "message" => "Error al registrar. El correo ya existe."]);
        }
        exit;
    }

    if ($option == "login") {
        $email    = $_POST["email"]    ?? "";
        $password = $_POST["password"] ?? "";

        $model   = new Usuario();
        $usuario = $model->login($email, $password);

        if ($usuario) {
            $_SESSION["sesionActiva"] = true;
            $_SESSION["nombre"]       = $usuario["nombre"];
            $_SESSION["email"]        = $usuario["email"];
            echo json_encode(["response" => "00", "message" => "Login exitoso", "nombre" => $usuario["nombre"]]);
        } else {
            echo json_encode(["response" => "01", "message" => "Correo o contrasena incorrectos."]);
        }
        exit;
    }

    if ($option == "adopcion") {
        $controller = new AdopcionController();
        $controller->guardar();
        exit;
    }

    if ($option == "donacion_monetaria") {
        $controller = new DonacionController();
        $controller->guardarMonetaria();
        exit;
    }

    if ($option == "donacion_otro") {
        $controller = new DonacionController();
        $controller->guardarOtro();
        exit;
    }

    if ($option == "voluntario") {
        $controller = new VoluntarioController();
        $controller->guardar();
        exit;
    }

    if ($option == "evento") {
        $controller = new EventoController();
        $controller->guardar();
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $option = $_GET['option'] ?? "";

    if ($option == "sesion") {
        if (isset($_SESSION["sesionActiva"]) && $_SESSION["sesionActiva"] === true) {
            echo json_encode(["response" => "00", "nombre" => $_SESSION["nombre"]]);
        } else {
            echo json_encode(["response" => "01"]);
        }
        exit;
    }

    if ($option == "eventos") {
        $controller = new EventoController();
        $controller->obtenerTodos();
        exit;
    }

    if ($option == "logout") {
        session_destroy();
        header("Location: public/login.html");
        exit;
    }
}