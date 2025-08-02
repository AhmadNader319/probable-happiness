<?php
require_once '../cors.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'] ?? null;

echo json_encode([
    "success" => true,
    "message" => "Task with ID $id deleted (simulated)."
]);
?>