<?php
require_once __DIR__ . "/../models/Evento.php";

class EventoController {
    public function guardar() {
        $titulo      = $_POST["titulo"]      ?? "";
        $descripcion = $_POST["descripcion"] ?? "";
        $fecha       = $_POST["fecha"]       ?? "";

        if ($titulo == "" || $descripcion == "" || $fecha == "") {
            echo json_encode(["ok" => false, "mensaje" => "Todos los campos son obligatorios."]);
            return;
        }

        $model = new Evento();
        if ($model->guardar($titulo, $descripcion, $fecha)) {
            echo json_encode(["ok" => true, "mensaje" => "Evento guardado correctamente."]);
        } else {
            echo json_encode(["ok" => false, "mensaje" => "Error al guardar."]);
        }
    }

    public function obtenerTodos() {
        $model = new Evento();
        echo json_encode($model->obtenerTodos());
    }
}

