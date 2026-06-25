<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

if (!isset($_SESSION["usuario_id"])) {

    echo json_encode([]);

    exit();

}

if ($_SESSION["usuario_tipo"] != "proprietario") {

    echo json_encode([]);

    exit();

}

$proprietario_id = $_SESSION["usuario_id"];

$sql = "

SELECT *

FROM quadras

WHERE proprietario_id = '$proprietario_id'

";

$result = $conn->query($sql);

$quadras = [];

while ($linha = $result->fetch_assoc()) {

    $quadras[] = $linha;

}

echo json_encode($quadras);