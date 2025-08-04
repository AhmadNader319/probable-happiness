<?php
include 'cors.php';
include 'db_connect.php';

$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);

$tasks = [];

while ($row = $result->fetch_assoc()) {
    $row["completed"] = (bool) $row["completed"];
    $tasks[] = $row;
}

echo json_encode($tasks);

$conn->close();
?>
