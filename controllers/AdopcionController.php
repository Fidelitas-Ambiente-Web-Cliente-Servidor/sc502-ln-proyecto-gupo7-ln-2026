<?php
require_once __DIR__ . "/../models/Adopcion.php";

class AdopcionController {
    public function guardar() {
        $nombre  = $_POST["nombre"]  ?? "";
        $mascota = $_POST["mascota"] ?? "";
        $fecha   = $_POST["fecha"]   ?? "";

        if ($nombre == "" || $mascota == "" || $fecha == "") {
            echo json_encode(["response" => "01", "message" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Adopcion();
        if ($model->guardar($nombre, $mascota, $fecha)) {
            echo json_encode(["response" => "00", "message" => "Adopcion registrada correctamente."]);
        } else {
            echo json_encode(["response" => "01", "message" => "Error al guardar."]);
        }
    }
}