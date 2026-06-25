<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "arena_facil";

$conn = new mysqli(
    $host,
    $usuario,
    $senha,
    $banco
);

if ($conn->connect_error) {

    die(
        "Erro de conexao: "
        . $conn->connect_error
    );

}

$conn->set_charset("utf8");
