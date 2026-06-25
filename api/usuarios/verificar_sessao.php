<?php

header("Content-Type: application/json");

session_start();

if (isset($_SESSION["usuario_id"])) {

    echo json_encode([

        "logado" => true,

        "nome" => $_SESSION["usuario_nome"],

        "tipo" => $_SESSION["usuario_tipo"]

    ]);

} else {

    echo json_encode([

        "logado" => false

    ]);

}