<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Activity 1 - Log In Page</title>
	<link rel = "stylesheet" type= "text/css" href="Design.css">
</head>
<body style="background-image: url(Purple3.jpg);">

	<div class="box1" style="background-color: #A44292;">
		<img src="RandomPic.png" class="Picture">
		<form action="" method="post" name="Login_Form">
	  		<table class="Table" align="right" border="0px">

			    

			    <tr>
			      <td class="welcome" style="position: absolute;" align="left" valign="top"><h3 style="margin-left: 30px">Welcome Back!</h3></td>
			    </tr>
			    
			    <tr>
			      <td><h3 class="Label">Login your Account</h3><input class="Input" name="Username" type="text" placeholder="Username" size="30"><input class="Input" name="Password" type="password" placeholder="Password" size="30" style=""></td>
			    </tr>

			    <tr>
			      <td style="text-align: center;"><input name="Submit" type="submit" value="Login" class="Button3"></td>
			    </tr>

			    <tr>
			    	<td style="text-align: center;">Forgot your Password?</td>
			    </tr>
	  		</table>
		</form>
	</div>

<?php session_start();
if(isset($_POST['Submit'])){

$logins = array('ADMIN' => 'ADMIN123');

$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
$Password = isset($_POST['Password']) ? $_POST['Password'] : '';
	
	if (isset($logins[$Username]) && $logins[$Username] == $Password){
		$_SESSION['UserData']['Username']=$logins[$Username];
		echo '<script>window.location.href="http://localhost/dashboard/AAAA/MEME.php"; alert("Log In Successful.")</script>';
	exit;
	}

	else {
	$msg="<span style='color:blue'>Invalid Login Details</span>";
	echo '<script>alert("Log In Failed.")</script>';
	}

}
?>

</body>
</html>