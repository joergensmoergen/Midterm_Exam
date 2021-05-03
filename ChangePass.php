<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body style="background-image: url(Purple3.jpg); background-size: cover;">
	<form method="post">

	<img src="Petals.gif" style="background-size: cover;width: 100%;height: 100%; opacity: 0.2">
	<div style="background-color: white;width: 1000px;height: 500px;position: absolute;top: 12%;left: 17%;border-radius: 20px">
		<img src="RandomPic.png" style="width: 100%;height: 100%;position: absolute;border-radius: 20px;">
		<div style="position: relative; z-index: 20;">
			<table align="center" style="margin-top: 50px;">
				<tr>
					<td><h3>Change Password</h3></td>
				</tr>
				<tr>
					<td><b>Current Password:</b></td>
					<td><input type="password" name="CurrentPass" id="CurrentPass" size="35"></td>
				</tr>
				<tr>
					<td><br><b>New Password:</b></td>
					<td><input type="password" name="NewPass" id="NewPass" size="35"></td>
				</tr>
				<tr>
					<td><br><b>Confirm Password:</b></td>
					<td><br><input type="password" name="ConfirmPass" id="ConfirmPass" size="35"></td>
				</tr>
				<tr>
					<td><button class="button" name="Save">Save</button></td>
					<td><button class="button" name="Cancel">Cancel</button></td>
				</tr>
			</table>
		</div>
	</div>

	</form>

<?php

if (isset($_POST['Save'])) {
	$con = mysqli_connect('localhost','root','','sir_reboya') or die("Connection Failed");

	$CurrentPass = $_POST['CurrentPass'];
	$NewPass = $_POST['NewPass'];
	$ConfirmPass = $_POST['ConfirmPass'];

	$Password = mysqli_query($con, "SELECT Password FROM sign_up");
	$num2 = mysqli_fetch_assoc($Password);
	$result = $num2['Password'];

	if ($CurrentPass == $result && $NewPass == $ConfirmPass) {
		$UserN = $_SESSION['UserN'];
		$Select = mysqli_query($con, "UPDATE sign_up SET Password = '$ConfirmPass' WHERE Username = '$UserN'");
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$act = "CHANGE PASSWORD";
		$Update = mysqli_query($con, "INSERT INTO event_log (Activity, Username, Date_Time) VALUES ('$act', '$UserN', '$time')");
		header("location:Homepage.php");

	}
}

	if (isset($_POST['Cancel'])) {
		header('location:MEME.php');
	}


?>

</body>
<style>
body{
	color: white;
}
.button{
	position: relative;
	background-color: #A44292;
	width: 250px;
	height: 50px;
	border-radius: 35px;
	color: white;
	font-family: arial;
	opacity: 1;
	transition: 0.3s;
	outline: 0px;
	z-index: 50;
}
.button:hover{
	background-color: #74326F;
}
</style>
</html>