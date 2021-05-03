<?php
session_start();
?>
<!DOCTYPE html>
<html  lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Forgot Password</title>
</head>
<body style="background-image: url(Purple3.jpg); background-size: cover;">
	<form method="post">
	<img src="Petals.gif" style="background-size: cover;width: 100%;height: 100%; opacity: 0.2">
	<div style="background-color: #A44292;width: 500px;height: 400px;position: absolute;top: 20%;left: 35%;border-radius: 20px">
		<img src="RandomPic.png" style="width: 100%;height: 100%;position: absolute;border-radius: 20px;">
		<div style="position: relative;z-index: 10">
			<table align="center" style="margin-top: 50px;">
				<tr>
					<td><h3>Enter Email</h3></td>
				</tr>
				<tr>
					<td><b>Email:</b></td>
					<td><input type="text" name="Email" id="Email" size="45"></td>
				</tr>
			</table><br><br><br><br>
			<center>
			<button id="submitemail" name="submitemail" class="button">Submit</button><br><br>
			<button id="cancel" name="cancel" class="button">Cancel</button>
			</center>
		</div>
	</div>
</form>


<?php

if (isset($_POST['submitemail'])) {
	$con = mysqli_connect('localhost','root','','sir_reboya') or die("Connection Failed");

	$Email = $_POST['Email'];
	$Select = mysqli_query($con, "SELECT * FROM sign_up WHERE Email = '$Email'");
	$num = mysqli_num_rows($Select);
	$UserN = mysqli_query($con, "SELECT Username FROM sign_up WHERE Email = '$Email'");
	$num2 = mysqli_fetch_assoc($UserN);
	$result = $num2['Username'];
	if ($num == 1) {
		$_SESSION['Email'] = $Email;
		$_SESSION['UserN'] = $result;
		echo "<script>alert('Valid Email');</script>";
		header('location:ResetPass.php');
	}
	else{
		echo "<script>alert('Invalid Email');</script>";
	}
}

if (isset($_POST['cancel'])) {
	$con = mysqli_connect('localhost','root','','sir_reboya') or die("Connection Failed");

	header('location:Homepage.php');
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