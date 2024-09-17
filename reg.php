<?php
session_start()
?>

<!DOCTYPE html>
<html>
  <head>
     <title>Registration</title>
</head>
  <body>
    <h2>Registration</h2>
    <table>
        <td>
<fieldset>
    <legend>Sing Up</legend>
    <table>
        <label for="fname">Full Name:</label>
        <input type="text" id="fname" name="fname" value=" "><br><br>

<p><strong>Gender :</strong>
     <input type="radio" id="html" name="Gender" value="Male"
     <label for="Male" >Male</label>
     <input type="radio" id="css" name="Gender" value="Female"
     <label for="Female" >Female</label><br></p><br>

    <label for="fname">Email:</label>
    <input type="text" id="fname" name="fname" value=" "><br><br>

    <label for="lname">Phone/Mobile</label>
<input type="text" id="lname" name="lname" value= ><br><br>

<td>
        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd"><br><br>

        <label for="pwd">Confirm Password:</label>
        <input type="password" id="pwd" name="pwd"><br><br>
    <input type="submit" value="Register"><br><br>


    </td>
</table>
</body>
</html>