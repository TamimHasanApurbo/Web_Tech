<?php
session_start();
include('../models/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $old_password = $_POST['old_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT); 

    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($old_password, $row['password'])) {
            
            $stmtUpdate = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmtUpdate->bind_param("ss", $new_password, $email);
            if ($stmtUpdate->execute()) {
                echo "Password changed successfully.";
            } else {
                echo "Error updating password.";
            }
            $stmtUpdate->close();
        } else {
            echo "Old password is incorrect.";
        }
    } else {
        echo "User not found.";
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
    <title>Change Password</title>
</head>
<body>
    <div class="container">
    <fieldset>
                <table>
        <h2>Change Password</h2>
        <form id="changePasswordForm">
            <input type="password" name="old_password" placeholder="Old Password" ><br><br>
            <input type="password" name="new_password" placeholder="New Password" ><br><br>
            <input type="password" name="confirm_new_password" placeholder="Confirm New Password" ><br><br>
            </table>
            </fieldset>
            <button type="submit">Change Password</button>
            <p id="changePasswordMsg" style="color: red;"></p>
        </form>
    </div>

    <script>
        document.getElementById("changePasswordForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            const newPassword = formData.get('new_password');
            const confirmNewPassword = formData.get('confirm_new_password');

            if (newPassword !== confirmNewPassword) {
                document.getElementById("changePasswordMsg").textContent = "New passwords do not match.";
                return;
            }

            const xhrCheckOldPassword = new XMLHttpRequest();
            xhrCheckOldPassword.open("POST", "", true); 
            xhrCheckOldPassword.onload = function () {
                if (xhrCheckOldPassword.status === 200) {
                    document.getElementById("changePasswordMsg").textContent = xhrCheckOldPassword.responseText;
                }
            };
            xhrCheckOldPassword.send(formData);
        });
    </script>
</body>
</html>
