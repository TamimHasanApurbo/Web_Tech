<?php
$db_host = 'localhost';
$db_email = 'root';  
$db_pass = '';      
$db_name = 'photo_gallery';
$conn = mysqli_connect($db_host, $db_email, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>