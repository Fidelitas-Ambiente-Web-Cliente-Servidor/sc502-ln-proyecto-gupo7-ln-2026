<?php
require_once __DIR__ . "/../models/Donacion.php";

class DonacionController {
    public function guardarMonetaria() {
        $nombre    = $_POST["nombre"]    ?? "";
        $monto     = $_POST["monto"]     ?? "";
        $fecha     = $_POST["fecha"]     ?? "";
        $tipo_pago = $_POST["tipo_pago"] ?? "";

        if ($nombre == "" || $monto == "" || $fecha == "" || $tipo_pago == "") {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Donacion();
        if ($model->guardarMonetaria($nombre, $monto, $fecha, $tipo_pago)) {
            echo json_encode(["ok" => true, "mensaje" => "Donacion registrada correctamente."]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar."]);
        }
    }

    public function guardarOtro() {
        $nombre         = $_POST["nombre"]         ?? "";
        $cantidad       = $_POST["cantidad"]       ?? "";
        $tipo_donacion  = $_POST["tipo_donacion"]  ?? "";
        $fecha          = $_POST["fecha"]          ?? "";

        if ($nombre == "" || $cantidad == "" || $tipo_donacion == "") {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Donacion();
        if ($model->guardarOtro($nombre, $cantidad, $tipo_donacion, $fecha)) {
            echo json_encode(["ok" => true, "mensaje" => "Donacion registrada correctamente."]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar."]);
        }
    }
}

