<?php
session_start();
include('../models/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $old_password = $_POST['old_password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($old_password, $row['password'])) {
            echo "true"; 
        } else {
            echo "false"; 
        }
    } else {
        echo "false"; 
    }

    $stmt->close();
    $conn->close();
}
?>
