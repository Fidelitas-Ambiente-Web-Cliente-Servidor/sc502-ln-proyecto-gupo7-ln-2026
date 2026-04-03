<?php
session_start();
header("Content-Type: application/json");

if (isset($_SESSION["sesionActiva"]) && $_SESSION["sesionActiva"] === true) {
    echo json_encode(["ok" => true, "nombre" => $_SESSION["nombre"]]);
} else {
    echo json_encode(["ok" => false]);
}