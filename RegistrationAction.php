<?php 

if ($_SERVER['REQUEST_METHOD'] === "POST") {

	$username = sanitize($_POST['username']);
	$password = sanitize($_POST['password']);
	$usernameErr = "";
	$passwordErr = "";
	$flag = true;

	if (empty($username)) {
		$flag = false;
		$usernameErr = "Please provide the username";
	}
	if (empty($password)) {
		$flag = false;
		$passwordErr = "Please provide the password";
	}

	if ($flag === true) {
		if ($username === "admin" and $password === "admin") {
			echo "You credentials matched";
		}
		else {
			echo "Login Failed...!";
		}
	}
	else {
		header("Location: registration.php?err1=" . $usernameErr . "&err2=" . $passwordErr);
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