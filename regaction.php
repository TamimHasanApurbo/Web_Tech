<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST") {

	$username = sanitize($_POST['email']);
	$password = sanitize($_POST['password']);
	$usernameErr = "";
	$passwordErr = "";
	$flag = true;

	$email = test_input($_POST["email"]);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}
	}
	if (empty($password)) {
		$flag = false;
		$passwordErr = "Please provide the password";
	}

	if ($flag === true) {
		if ($email === "admin" and $password === "admin") {
			echo "You credentials matched";
		}
		else {
			echo "Login Failed...!";
		}
	}
	else {
		header("Location: registration.php?err1=" . $emailErr . "&err2=" . $passwordErr);
	}

}
else {
	echo "Unauthorized Access;";
}

function sanitize($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

?>