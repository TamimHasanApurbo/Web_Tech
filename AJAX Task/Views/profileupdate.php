<?php
session_start();
include('../models/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, phone = ?, gender = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $email, $phone, $gender, $user_id);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile.";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../style.css"> 

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Profile</title>
</head>
<body>
    <div class="container">
    <fieldset>
    <table>
        <h2>Update Profile</h2>
        <form id="updateProfileForm">
            <input type="text" name="name" placeholder="Name" ><br><br>
            <input type="email" name="email" placeholder="Email" ><br><br>
            </table>
            </fieldset>
