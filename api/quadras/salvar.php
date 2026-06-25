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

if ($_SESSION["usuario_tipo"] != "proprietario") {

    echo json_encode([

        "status" => "error",

        "message" => "Acesso negado."

    ]);

    exit();

}

$data = json_decode(

file_get_contents("php://input")

);

$nome = $data->nome;

$tipo = $data->tipo;

$preco = $data->preco ?? $data->preco_hora;

$proprietario_id =

$_SESSION["usuario_id"];

$sql = "

INSERT INTO quadras

(

nome,

tipo,

preco_hora,

proprietario_id

)

VALUES

(

'$nome',

'$tipo',







'$preco',

'$proprietario_id'

)

";

if ($conn->query($sql)) {

    echo json_encode([

        "status" => "success",

        "message" => "Quadra cadastrada com sucesso!"

    ]);

} else {

    echo json_encode([

        "status" => "error",

        "message" => "Erro ao cadastrar quadra!"

    ]);

}
