<?php

header("Content-Type: application/json");

session_start();

require_once "../config/database.php";

$data = json_decode(
    file_get_contents("php://input")
);

$email = $data->email;

$senha = $data->senha;

$sql = "

SELECT *

FROM usuarios

WHERE email = '$email'

";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $usuario = $result->fetch_assoc();

    $senha_valida = password_verify($senha, $usuario["senha"]);

    if (!$senha_valida && hash_equals($usuario["senha"], $senha)) {

        $senha_valida = true;

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $usuario_id = $usuario["id"];

        $conn->query(
            "UPDATE usuarios
            SET senha = '$senha_hash'
            WHERE id = '$usuario_id'"
        );

    }

    if (!$senha_valida) {

        echo json_encode([

            "status" => "error",

            "message" => "Email ou senha inválidos!"

        ]);

        exit();

    }

    $_SESSION["usuario_id"] =
    $usuario["id"];

    $_SESSION["usuario_nome"] =
    $usuario["nome"];

    $_SESSION["usuario_tipo"] =
    $usuario["tipo"];

    echo json_encode([

        "status" => "success",

        "message" => "Login realizado com sucesso!",

        "tipo" => $usuario["tipo"]

    ]);

} else {

    echo json_encode([

        "status" => "error",

        "message" => "Email ou senha inválidos!"

    ]);

}
