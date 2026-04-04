<?php
require_once __DIR__ . "/../models/Voluntario.php";

class VoluntarioController {
    public function guardar() {
        $nombre             = $_POST["nombre"]             ?? "";
        $telefono           = $_POST["telefono"]           ?? "";
        $correo             = $_POST["correo"]             ?? "";
        $tipo_voluntariado  = $_POST["tipo_voluntariado"]  ?? "";

        if ($nombre == "" || $telefono == "" || $correo == "") {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Voluntario();
        if ($model->guardar($nombre, $telefono, $correo, $tipo_voluntariado)) {
            echo json_encode(["ok" => true, "mensaje" => "Voluntario registrado correctamente."]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar."]);
        }
    }
}

