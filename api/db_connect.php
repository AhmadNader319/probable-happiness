<?php
$servername = "replace-with-your-server-name";
$username = "replace-with-your-username";
$password = "replace-with-your-password";
$dbname = "replace-with-your-dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
