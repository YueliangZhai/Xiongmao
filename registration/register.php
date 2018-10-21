<?php // register.php

// ToDo:
// 1. add checking for already registered user email
// 2. 
session_start();
include "../dbconnect.php";

if (empty($_POST['user_firstName']) ) {
	// no post form

}
else {
	$firstName = $_POST['user_firstName'];
	$lastName = $_POST['user_lastName'];
	$email = $_POST['user_email'];
	$password = $_POST['user_password'];
	$password2 = $_POST['user_password_confirm'];


	if ($password != $password2) {
		echo '<script language="javascript">';
		echo 'alert("Sorry, password does not match.")';
		echo '</script>';
		}
	else {
		$password = md5($password);
		$query = "INSERT INTO users (user_firstName, user_lastName, user_email, user_password) 
				VALUES ('$firstName', '$lastName', '$email', '$password')";
		$result = mysqli_query($con, $query);

		if (!$result) {
			echo '<script language="javascript">';
			echo "alert('The E-mail $email has already been registered. Login instead.')"; // currenyly any insertion error will lead to this. maybe fix later
			echo '</script>';	}

		else{
			echo '<script language="javascript">';
			echo 'alert("You have sucessfully registered! Now login to confirm.")';
			echo '</script>';
		}
	}
}

// if not logged in
if (!isset($_SESSION['user_id'])){
	$show_div = '
				<h2>Login</h2>
				<form method="post" action="../registration/login.php" id="info"> <!-- maybe add input checking here -->
						<label for="logEmail">* E-mail:</label>
						<input type="email" name="user_email" id="logEmail" required><br>
						<label for="logPassword">* Password:</label>
						<input type="password" name="user_password" id="logPassword" required><br>
						<input id="logSubmit" type="submit" value="Submit">
				</form>';
}
// if logged in 
else{
	$email = $_SESSION['user_email'];
	$show_div = "
				<h2>Logout</h2>
				You are logged in using $email
				<form method='pose' action='../registration/logout.php'>
					<input type='submit' value='Logout'> 
				</form>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Xiong Mao - Account</title>
<meta charset="utf-8">
<link rel="stylesheet" href="../xiongmao.css">
<style>
#header {
	text-align: center;
	vertical-align: middle;
}
#user {
	text-align: center;
}
#login {
	width: 600px;
	text-align: center;
	display: inline-block;
}
#register {
	width: 600px;
	text-align: center;
	vertical-align: top;
	display: inline-block;
}
h2 {
	color:#FF476F;
}
form {
	line-height: 250%;
}
label {
	text-align: right; 
	width: 15%;
	display: inline-block;
}  
input, select {
	margin-left: 20px;
	text-align: left;
	display: inline-block;
}	             
</style>
<script>
	function checkInput(){
		var fname = document.getElementById("regFname");
	    var nameRegExp = /^[A-Za-z]+$/;
		var nameValid = nameRegExp.test(fname.value);
   		if (nameValid != true) {
			alert("The first name is not valid.\n" + "It should contain only alphabet characters.");
			fname.focus();
			fname.select();
			return false;
		}

		var lname = document.getElementById("regLname");
	    var nameRegExp = /^[A-Za-z]+$/;
		var nameValid = nameRegExp.test(lname.value);
   		if (nameValid != true) {
			alert("The last name is not valid.\n" + "It should contain only alphabet characters.");
			lname.focus();
			lname.select();
			return false;
		}
	

</script>
</head>
<body>
<div id="title-left">
	<img src="../Assets/logo.png" id="logo" width="204" height="103">
</div>
<div id="title-right">
	<header>
		<h1>Xiong Mao</h1>
	</header>
	<nav>
		<a href="../home.html">Home</a>
		<a href="../menu.html">Menu</a>
		<a href="../reservation.html">Reservation</a>
		<a href="../delivery.html">Delivery</a>
		<a href="../event.html">Event</a>
		<a href="../contact.html">Contact</a>
		<a href="./register.php">Account</a>
	</nav>
</div>
<div id="user">
	<div id="header">
		<img src="../Assets/headerLoginRegister.png" width="1400" height="300">	
	</div>



	<div id="login">
		<?php echo $show_div; ?>
	</div>

	<div id="register">
		<h2>Register</h2>
		<form method="post" action="../registration/register.php" id="info" onsubmit="return checkInput();">
				<label for="regSalulation">* Salulation:</label>
				<select>
					<option value="Mr.">Mr.</option>
					<option value="Ms.">Ms.</option>
				</select><br>
  				<label for="regFname">* First Name:</label>
  				<input type="text" id="regFname" name="user_firstName" required><br>
				<label for="regLname">* Last Name:</label>
  				<input type="text" id="regLname" name="user_lastName" required><br>
				<label for="regEmail">* E-mail:</label>
  				<input type="email" id="regEmail" name="user_email" required><br>
				<label for="regPassword">* Password:</label>
				<input type="password" id="regPassword" name="user_password" placeholder="Password" required><br>
				<label for="regPasswordConfirm">* Confirm:</label>
				<input type="password" id="regPasswordConfirm" name="user_password_confirm" placeholder="Confirm your Password" required><br>				
				<input id="regSubmit" type="submit" value="Submit">
		</form>
	</div>
</div>
<footer>
	<small>Nanyang Technological University, #01-01 Nanyang Center, 50 Nanyang Walk, Singapore 639929<br>
		Tel: 8888 6666 | Email: <a href="mailto:xiongmao@xiongmao.com">xiongmao@xiongmao.com</a><br>
		<i>Copyright &copy; 2018 Xiong Mao, Inc.<br></i></small>	
</footer>
</body>
</html>