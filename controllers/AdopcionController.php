<?php
require_once __DIR__ . "/../models/Adopcion.php";

class AdopcionController {
    public function guardar() {
        $nombre  = $_POST["nombre"]  ?? "";
        $mascota = $_POST["mascota"] ?? "";
        $fecha   = $_POST["fecha"]   ?? "";

        if ($nombre == "" || $mascota == "" || $fecha == "") {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Adopcion();
        if ($model->guardar($nombre, $mascota, $fecha)) {
            echo json_encode(["ok" => true, "mensaje" => "Adopcion registrada correctamente."]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar."]);
        }
    }
}

