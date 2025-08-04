<?php
// Enable CORS
include 'cors.php'; // Must be at the very top

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Preflight request handling
    http_response_code(200);
    exit();
}

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Parse incoming JSON
    $data = json_decode(file_get_contents("php://input"), true);

    $title = $data['title'] ?? null;
    $completed = $data['completed'] ?? 0;

    // Check if title exists
    if ($title !== null) {
        $stmt = $conn->prepare("INSERT INTO tasks (title, completed, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("si", $title, $completed);

        if ($stmt->execute()) {
            echo json_encode([
                "success" => true,
                "id" => $stmt->insert_id,
                "title" => $title,
                "completed" => $completed
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["success" => false, "error" => $stmt->error]);
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "error" => "Missing title"]);
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "error" => "Method Not Allowed"]);
}

$conn->close();
?>
