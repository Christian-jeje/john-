<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    exit(json_encode(['error' => 'Unauthorized']));
}

$server = "localhost";
$user = "root"; 
$password = ""; 
$dbname = "chatbuddy";

$conn = new mysqli($server, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$message = $_POST['message'];

// Save the user message
$stmt = $conn->prepare("INSERT INTO chat_history (username, sender, message, timestamp) VALUES (?, 'user', ?, NOW())");
$stmt->bind_param("ss", $username, $message);
$stmt->execute();

// Respond with a bot message (basic response example)
$botResponse = "You said: " . $message;
$stmt = $conn->prepare("INSERT INTO chat_history (username, sender, message, timestamp) VALUES (?, 'bot', ?, NOW())");
$stmt->bind_param("ss", $username, $botResponse);
$stmt->execute();

$stmt->close();
$conn->close();

echo json_encode(['botMessage' => $botResponse]);
?>
