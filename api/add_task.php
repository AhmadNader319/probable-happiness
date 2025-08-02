<?php
require_once '../cors.php';

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'] ?? 'Untitled';

$newTask = [
    "id" => rand(1000, 9999),
    "title" => $title,
    "completed" => false
];

echo json_encode(["success" => true, "task" => $newTask]);
?>