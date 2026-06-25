<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] != "proprietario") {

    echo json_encode([
        "status" => "error",
        "message" => "Acesso negado."
    ]);

    exit();

}

$data = json_decode(file_get_contents("php://input"));

$id = $data->id ?? $_GET["id"] ?? null;

if (!$id) {

    echo json_encode([
        "status" => "error",
        "message" => "Quadra inválida."
    ]);

    exit();

}

$proprietario_id = $_SESSION["usuario_id"];

$sql = "DELETE FROM quadras
WHERE id = '$id'
AND proprietario_id = '$proprietario_id'";

if ($conn->query($sql) === TRUE) {

    if (isset($_GET["id"])) {

        header("Location: ../../frontend/minhas_quadras.html");
        exit;

    }

    echo json_encode([
        "status" => "success",
        "message" => "Quadra excluída com sucesso!"
    ]);

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Erro ao excluir quadra."
    ]);

}

?>
