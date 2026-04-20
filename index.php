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

$option = $_REQUEST['option'] ?? "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($option === "registro") {

        $nombre   = $_POST["nombre"] ?? "";
        $email    = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        $confirm  = $_POST["confirm"] ?? "";

        if ($password !== $confirm) {
            echo json_encode([
                "response" => "01",
                "message" => "Las contraseñas no coinciden."
            ]);
            exit;
        }

        $model = new Usuario();

        if ($model->registrar($nombre, $email, $password)) {
            echo json_encode([
                "response" => "00",
                "message" => "Registro exitoso. Ahora inicia sesión."
            ]);
        } else {
            echo json_encode([
                "response" => "01",
                "message" => "Error al registrar. El correo ya existe."
            ]);
        }
        exit;
    }

    if ($option === "login") {

        $email    = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        $model   = new Usuario();
        $usuario = $model->login($email, $password);

        if ($usuario) {

            $_SESSION["sesionActiva"] = true;
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["email"]  = $usuario["email"];

            echo json_encode([
                "response" => "00",
                "message" => "Login exitoso",
                "nombre" => $usuario["nombre"]
            ]);
        } else {
            echo json_encode([
                "response" => "01",
                "message" => "Correo o contraseña incorrectos."
            ]);
        }
        exit;
    }

    if ($option === "adopcion") {
        (new AdopcionController())->guardar();
        exit;
    }

    if ($option === "donacion_monetaria") {
        (new DonacionController())->guardarMonetaria();
        exit;
    }

    if ($option === "donacion_otro") {
        (new DonacionController())->guardarOtro();
        exit;
    }

    if ($option === "voluntario") {
        (new VoluntarioController())->guardar();
        exit;
    }

    if ($option === "evento") {
        (new EventoController())->guardar();
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if ($option === "sesion") {

        if (!empty($_SESSION["sesionActiva"])) {
            echo json_encode([
                "response" => "00",
                "nombre" => $_SESSION["nombre"]
            ]);
        } else {
            echo json_encode(["response" => "01"]);
        }
        exit;
    }

    if ($option === "eventos") {
        (new EventoController())->obtenerTodos();
        exit;
    }

    if ($option === "logout") {
        session_destroy();
        echo json_encode([
            "response" => "00",
            "message" => "Sesión cerrada"
        ]);
        exit;
    }

    if ($option === "estadisticas") {

        $db = (new Database())->connect();

        $eventos = $db->query("SELECT COUNT(*) AS total FROM eventos")
            ->fetch_assoc()['total'] ?? 0;

        $adopciones = $db->query("SELECT COUNT(*) AS total FROM adopciones")
            ->fetch_assoc()['total'] ?? 0;

        $donacionesMonetarias = $db->query("SELECT SUM(monto) AS total FROM donaciones_monetarias")
            ->fetch_assoc()['total'] ?? 0;

        $donacionesOtros = $db->query("SELECT COUNT(*) AS total FROM donaciones_otros")
            ->fetch_assoc()['total'] ?? 0;

        $voluntarios = $db->query("SELECT COUNT(*) AS total FROM voluntarios")
            ->fetch_assoc()['total'] ?? 0;

        echo json_encode([
            "eventos" => $eventos,
            "adopciones" => $adopciones,
            "donaciones" => $donacionesMonetarias + $donacionesOtros,
            "voluntarios" => $voluntarios
        ]);

        exit;
    }
}