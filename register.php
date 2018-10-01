<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="style.css" type="text/css" />

	</head>

	<body>
		<center>
			<div id="login-form">
				<form method="post">
					<table align="center" width="30%" border="0">
						<tr>
							<td>
								<input type="text" name="uname" placeholder="User Name" required />
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="lastName" placeholder="Last Name" required />
							</td>
						</tr>
						<tr>
							<td>
								<input type="text" name="firstName" placeholder="First Name" required />
							</td>
						</tr>
						<tr>
							<td>
								<input type="password" name="pass" placeholder="Your Password" required />
							</td>
						</tr>
						<tr>
							<td>
								<button type="submit" name="btn-signup">Sign Me Up</button>
							</td>
						</tr>
						<tr>
							<td>
								<a href="index.php">Sign In Here</a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</center>
	</body>


	<?php
session_start();
if(isset($_SESSION['user'])!=""){
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup'])){
	$userName = mysqli_real_escape_string($link,$_POST['uname']);
	$lastName = mysqli_real_escape_string($link,$_POST['lastName']);
	$firstName = mysqli_real_escape_string($link,$_POST['firstName']);
	$passHash = md5(mysqli_real_escape_string($link,$_POST['pass']));
	
	if(mysqli_query($link,"INSERT INTO users(LastName,FirstName,UserName,PassHash) VALUES('$lastName','$firstName','$userName','$passHash')")){
		echo "<script>alert('successfully registered ')</script>";
	}
	else{
        die('error, ' . mysqli_error($link));
	}
}
?>

</html>