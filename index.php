<?php
	session_start();
	include_once('dbconnect.php');

	isSecure();
	
	include_once 'dbconnect.php';
	if(isset($_SESSION['userID'])!=""){
		header("Location: home.php");
	}
	if(isset($_POST['btn-login'])){
		$uname = mysqli_real_escape_string($link,$_POST['uname']);
		$upass = mysqli_real_escape_string($link,$_POST['pass']);
		$res=mysqli_query($link,"SELECT * FROM users WHERE UserName='$uname'");
		$row=mysqli_fetch_array($res);
		if($row['PassHash']==md5($upass)){
			$_SESSION['userID'] = $row['UserID'];
			echo "<script>alert('Logged In');</script>";
			header("Location: home.php");
		}
		else{
			echo "<script>alert('wrong details');</script>";
		}	
	}
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>

	<body>
		<div id="loginDiv">
			<form id="loginform" method="post">
				<input id="uname" type="text" name="uname" placeholder="Your Username" required />
				<input id="pass" type="password" name="pass" placeholder="Your Password" required />
				<button id="logsub" type="submit" name="btn-login">Sign In</button>
				<a href="register.php">Sign Up Here</a>
			</form>
			<iframe id="video" width="640" height="360" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
		</div>
	</body>
</html>

	<?php
	function isSecure() {
		return
		(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
	}
?>
