<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] != "proprietario") {

    echo json_encode([]);

    exit();

}

$proprietario_id = $_SESSION["usuario_id"];

$sql = "SELECT reservas.*,
usuarios.nome AS usuario,
quadras.nome AS quadra

FROM reservas

INNER JOIN usuarios
ON reservas.usuario_id = usuarios.id

INNER JOIN quadras
ON reservas.quadra_id = quadras.id

WHERE quadras.proprietario_id = '$proprietario_id'

ORDER BY reservas.data_reserva, reservas.horario";

$result = $conn->query($sql);

$reservas = [];

while ($row = $result->fetch_assoc()) {

    $reservas[] = $row;

}

echo json_encode($reservas);
