<?php

header("Content-Type: application/json");

require_once "../config/database.php";

$sql = "SELECT * FROM quadras";

$result = $conn->query($sql);

$quadras = [];

while($row = $result->fetch_assoc()) {

    $quadras[] = $row;

}

echo json_encode($quadras);