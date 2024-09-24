<?php
session_start();
include('../models/database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

  
    $stmt = $conn->prepare("INSERT INTO users (name, email, phone, gender, password) VALUES (?, ?, ?, ?, ?)");
    
  
    if (!$stmt) {
        die("Preparation failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $name, $email, $phone, $gender, $password);
    
    
    if ($stmt->execute()) {
        echo "success"; 
    } else {
        echo "error: " . $stmt->error; 
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
    <title>Registration</title>
</head>
<body>
    <div class="container">
    <fieldset>
    <table>
        <h2>Registration</h2>
        <form id="registrationForm">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="text" name="phone" placeholder="Phone/Mobile" required><br><br>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br><br>
            </table>
            </fieldset>
            <button type="submit">Register</button>
            <p id="registrationMsg" style="color: red;"></p>
        </form>
    </div>

    <script>
        document.getElementById("registrationForm").addEventListener("submit", function (e) {
            e.preventDefault(); 

            const formData = new FormData(this);
            const email = formData.get('email');

          
            const xhrCheckEmail = new XMLHttpRequest();
            xhrCheckEmail.open("POST", "../controllers/check_email.php", true);
            xhrCheckEmail.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhrCheckEmail.onload = function () {
                if (xhrCheckEmail.status === 200) {
                    if (xhrCheckEmail.responseText === "exists") {
                        document.getElementById("registrationMsg").textContent = "Email already exists.";
                    } else {
                        
                        const xhrRegister = new XMLHttpRequest();
                        xhrRegister.open("POST", "", true); 
                        xhrRegister.onload = function () {
                            if (xhrRegister.status === 200) {
                                alert(xhrRegister.responseText);
                                
                            }
                        };
                        xhrRegister.send(formData);
                    }
                }
            };
            xhrCheckEmail.send("email=" + encodeURIComponent(email));
        });
    </script>
</body>
</html>
