<?php
session_start();
require_once 'config.php';
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email)) {
        $error = "Email is required.";
    } elseif (empty($password)) {
        $error = "Password is required.";
    } else {
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                header("Location: gallery.php");
                exit();
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<fieldset>
<legend>Login</legend>

        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="login.php" method="post" novalidate>
        <label for="fname">Email:</label>
        <input type="text" name="email" placeholder="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br><br>

        <label for="pwd">Confirm Password:</label>
            <input type="password" name="password" placeholder="Password"><br><br>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="reg.php">Register here</a></p>
    </div>
</body>
</html>