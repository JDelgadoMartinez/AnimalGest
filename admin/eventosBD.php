<?php
session_start();
include_once '../ModeloBD.php';
$conexiondb = new ModeloBD("animalgest");

$accion = (isset($_GET['accion'])) ? $_GET["accion"] : 'leer';

switch ($accion) {
    case "agregar":
        $titulo = $_POST["title"];
        $descripcion = $_POST["descripcion"];
        $color = $_POST["color"];
        $textColor = $_POST["textColor"];
        $start = $_POST["start"];
        $end = $_POST["end"];
        $query = "INSERT INTO `eventos`(`title`, `descripcion`, `color`, `textColor`, `start`, `end`)"
            . "VALUES ('" . $titulo . "','" . $descripcion . "','" . $color . "','" . $textColor . "','" . $start . "','" . $end . "')";
        $conexiondb->execute_single_query($query);
        echo json_encode($query);
        break;

    case "actualizar":
        $idEvento = $_POST["id"];
        $titulo = $_POST["title"];
        $descripcion = $_POST["descripcion"];
        $color = $_POST["color"];
        $textColor = $_POST["textColor"];
        $start = $_POST["start"];
        $end = $_POST["end"];

        $query = "UPDATE eventos "
            . "SET title='$titulo', descripcion='$descripcion', color='$color', textColor='$textColor', start='$start', end='$end'"
            . " WHERE idEvento=".$idEvento;
        $conexiondb->execute_single_query($query);
        echo json_encode($query);
        break;

    case "eliminar":
        $idEvento = $_POST["id"];
        $query = "DELETE FROM eventos"
            . " WHERE idEvento=" . $idEvento;
        $conexiondb->execute_single_query($query);
        echo json_encode($query);
        break;

    default:
        $conexiondb->get_results_from_query("SELECT * FROM eventos");
        $eventos = $conexiondb->get_rows();
        echo json_encode($eventos);
        break;
}
