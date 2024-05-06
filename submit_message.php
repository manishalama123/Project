<?php
session_start();
include('connection.php');
if (!isset($_SESSION['name'])) {
    exit("You are not logged in");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (similar to chat.php)

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat_messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
    $con->query($sql);
    $con->close();
}


?>