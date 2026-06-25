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

$data = json_decode(
    file_get_contents("php://input")
);

$quadra_id = $data->quadra_id;

$data_reserva = $data->data_reserva;

$horario = $data->horario;

$usuario_id = $_SESSION["usuario_id"];

$verifica = "

SELECT *

FROM reservas

WHERE quadra_id = '$quadra_id'

AND data_reserva = '$data_reserva'

AND horario = '$horario'

AND status != 'cancelada'

";

$resultado = $conn->query($verifica);

if ($resultado->num_rows > 0) {

    echo json_encode([

        "status" => "error",

        "message" => "Horário já reservado!"

    ]);

    exit();

}

$sql = "

INSERT INTO reservas

(

usuario_id,

quadra_id,

data_reserva,

horario

)

VALUES

(

'$usuario_id',

'$quadra_id',

'$data_reserva',

'$horario'

)

";

if ($conn->query($sql) === TRUE) {

    echo json_encode([

        "status" => "success",

        "message" => "Reserva realizada com sucesso!"

    ]);

} else {

    echo json_encode([

        "status" => "error",

        "message" => "Erro ao realizar reserva!"

    ]);

}