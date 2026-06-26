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

$proprietario_id = $_SESSION["usuario_id"];

// Normaliza e valida preço (evita valores negativos e problemas com vírgula decimal)
$preco_str = is_string($preco) ? trim($preco) : (string)$preco;
$preco_str = str_replace(' ', '', $preco_str);
$preco_str = str_replace(',', '.', $preco_str);

if ($preco_str === '' || !is_numeric($preco_str)) {

    echo json_encode([

        "status" => "error",

        "message" => "Preço inválido."

    ]);

    exit();

}

$preco_num = (float)$preco_str;

// Regra solicitada: valor menor que zero não pode
if ($preco_num < 0) {

    echo json_encode([

        "status" => "error",

        "message" => "Preço não pode ser menor que zero."

    ]);

    exit();

}

$stmt = $conn->prepare("INSERT INTO quadras (nome, tipo, preco_hora, proprietario_id) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdi", $nome, $tipo, $preco_num, $proprietario_id);

if ($stmt->execute()) {

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
