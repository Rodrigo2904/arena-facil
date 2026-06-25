<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

if (!isset($_SESSION["usuario_id"])) {

    echo json_encode([]);

    exit();

}

$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT reservas.*,
quadras.nome AS quadra_nome

FROM reservas

INNER JOIN quadras
ON reservas.quadra_id = quadras.id

WHERE reservas.usuario_id = '$usuario_id'

ORDER BY reservas.data_reserva, reservas.horario";

$result = $conn->query($sql);

$reservas = [];

while($row = $result->fetch_assoc()) {

    $reservas[] = $row;

}

echo json_encode($reservas);
