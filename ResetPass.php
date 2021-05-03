<?php
session_start();
?>
<!DOCTYPE html>
<html  lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Reset Password</title>
</head>
<body style="background-image: url(Purple3.jpg); background-size: cover;">
	<form method="post">
	<img src="Petals.gif" style="background-size: cover;width: 100%;height: 100%; opacity: 0.2">
	<div style="background-color: #A44292;width: 500px;height: 400px;position: absolute;top: 20%;left: 35%;border-radius: 20px">
		<img src="RandomPic.png" style="width: 100%;height: 100%;position: absolute;border-radius: 20px;">
		<div style="position: relative;z-index: 10">
			<table align="center" style="margin-top: 50px;">
				<tr>
					<td><h3>Type New Password</h3></td>
				</tr>
				<tr>
					<td><b>New Password:</b></td>
					<td><input type="password" name="NewPass" id="NewPass" size="35"></td>
				</tr>
				<tr>
					<td><br><b>Confirm Password:</b></td>
					<td><br><input type="password" name="ConfirmPass" id="ConfirmPass" size="35"></td>
				</tr>
			</table><br><br><br><br>
			<center>
			<button id="submitemail" name="submitemail" class="button">Submit</button><br><br>
			<button class="button" onclick="document.location='Homepage.php'">Cancel</button>
			</center>
		</div>
	</div>
</form>


<?php

if (isset($_POST['submitemail'])) {
	$con = mysqli_connect('localhost','root','','sir_reboya') or die("Connection Failed");

	$NewPass = $_POST['NewPass'];
	$ConfirmPass = $_POST['ConfirmPass'];
	if ($NewPass == $ConfirmPass) {
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$act = "RESET PASSWORD";
		$Mails = $_SESSION['Email'];
		$UserN = $_SESSION['UserN'];
		$Select = mysqli_query($con, "UPDATE sign_up SET Password = '$NewPass' WHERE Email = '$Mails'");
		$Select2 = mysqli_query($con, "INSERT INTO event_log (Activity, Username, Date_Time) VALUES ('$act', '$UserN', '$time')");
		echo "<script>alert('Password Reset Successfully')</script>";
		header("location:Homepage.php");
	}
	else{
		echo "<script>alert('Password does not Match');</script>";
	}
}

?>






</body>
<style>
body{
	color: white;
}
.button{
	background-color: #A44292;
	width: 250px;
	height: 50px;
	border-radius: 35px;
	color: white;
	font-family: arial;
	opacity: 1;
	transition: 0.3s;
	outline: 0px;
}
.button:hover{
	background-color: #74326F;
}

</style>
</html>