<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="chatbot-container">
        <div class="chat-header">
            <div class="chatbot-face"></div>
            <h2>ChatBuddy</h2>
            <button><a href="logout.php">Log out</a></button>
        </div>
        <div class="chat-area" id="chat-area">
            <div class="message bot">How can I assist you today?</div>
        </div>
        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Say something...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
