<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

if (!isset($_SESSION["usuario_id"])) {

    echo json_encode([
        "status" => "error",
        "message" => "Usuário não autenticado."
    ]);

    exit();

}

$data = json_decode(file_get_contents("php://input"));

$id = $data->id;

$usuario_id = $_SESSION["usuario_id"];

$tipo = $_SESSION["usuario_tipo"];

if ($tipo == "proprietario") {

    $sql = "UPDATE reservas

    INNER JOIN quadras
    ON reservas.quadra_id = quadras.id

    SET reservas.status = 'cancelada'

    WHERE reservas.id = '$id'
    AND quadras.proprietario_id = '$usuario_id'";

} else {

    $sql = "UPDATE reservas

    SET status = 'cancelada'

    WHERE id = '$id'
    AND usuario_id = '$usuario_id'";

}

if ($conn->query($sql) === TRUE) {

    echo json_encode([
        "status" => "success",
        "message" => "Reserva cancelada!"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Erro ao cancelar!"
    ]);

}
