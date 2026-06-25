<?php

header("Content-Type: application/json");

require_once "../config/database.php";

$data = json_decode(file_get_contents("php://input"));

$nome = $data->nome;
$email = $data->email;
$senha = password_hash($data->senha, PASSWORD_DEFAULT);
$tipo = $data->tipo ?? "cliente";

$verifica = "SELECT * FROM usuarios
WHERE email = '$email'";

$resultado = $conn->query($verifica);

if ($resultado->num_rows > 0) {

    echo json_encode([
        "status" => "error",
        "message" => "Email já cadastrado!"
    ]);

} else {

    $sql = "INSERT INTO usuarios
    (nome, email, senha, tipo)
    VALUES
    ('$nome', '$email', '$senha', '$tipo')";

    if ($conn->query($sql) === TRUE) {

        echo json_encode([
            "status" => "success",
            "message" => "Usuário cadastrado com sucesso!"
        ]);

    } else {

        echo json_encode([
            "status" => "error",
            "message" => "Erro ao cadastrar!"
        ]);

    }

}
