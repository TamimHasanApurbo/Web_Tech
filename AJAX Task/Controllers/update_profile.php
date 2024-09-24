<?php
session_start();
include('../models/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $new_email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET email = ? WHERE id = ?");
    $stmt->bind_param("si", $new_email, $user_id);

    if ($stmt->execute()) {
        echo "success"; 
    } else {
        echo "error"; 
    }

    $stmt->close();
    $conn->close();
}
?>
