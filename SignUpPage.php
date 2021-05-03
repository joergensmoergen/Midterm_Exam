<?php
session_start();
?>
<!DOCTYPE html>

<?php 

	if(isset($_POST['Submit'])){
		$UserN = $_POST['Username'];
		$Pass = $_POST['Confirm'];
		$Mail = $_POST['Email'];
		$Upper = preg_match('@[A-Z]@',$Pass);
		$Lower = preg_match('@[a-z]@', $Pass);
		$Number = preg_match('@[0-9]@', $Pass);
		$Chara = preg_match('@[^\w]@', $Pass);

		if (!$Upper || !$Lower || !$Number || !$Chara || strlen($Pass) <= 8) {
			echo '<script>alert("Your password must be between 8 and 30 characters, and must contain at least one (1) number, one (1) capital letter, and one (1) special character.")</script>';
		}
		else{
		$Host = "localhost";
		$User = "root";
		$dbPass = "";
		$dbName = "sir_reboya";
		$con = mysqli_connect($Host, $User, $dbPass, $dbName) or die("Connection Failed");
		}
	}	

?>


<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Sign Up Page</title>
</head>
<body style="background-image: url(Purple3.jpg); background-size: cover;">
	<form action="" method="post">
	<div class="Div1"  style="background-color: #A44292;">
		<img src="RandomPic.png" class="Picture">
		<img src="RandomPic2.png" class="Picture2">
		<div class="Div2">
			<table>
				<tr><td class="welcome" style="width: 500px;"><h3 style="text-align: center;">Register Your Account</h3></td></tr>
			</table><br>
				<h4 align="center">Kindly fill up the information needed. Do not leave any box empty.</h4>
			<table border="0px;" width="500px">
				<tr>
					<td align="center"><input class="textbox" name="Username" id="Username" type="text" placeholder="Username" size="40"	required></td>
				</tr>
				<tr>
					<td align="center"><br><input class="textbox" name="Password" id="Password" type="Password" placeholder="Password" size="40" required></td>
				</tr>
				<tr>
					<td align="center"><br><input class="textbox" name="Confirm" id="Confirm" type="Password" placeholder="Confirm Password" size="40" required>
					<?php  
					 if(isset($_POST['Submit'])){
						$ConPass = $_POST['Password'];
						$Pass = $_POST['Confirm'];

						if($ConPass != $Pass){
						echo "<b> <font color=red><br>* Passwords do not match</font></b> <br> "; 
						}else{}
					}
					?>
					</td>
				</tr>
				<tr>
					<td align="center"><br><input class="textbox" name="Email" type="text" placeholder="Email" size="40" required>
					<?php  
					if(isset($_POST['Submit'])){
						$Mail = $_POST['Email'];
						if(!filter_var($Mail, FILTER_VALIDATE_EMAIL)){
						echo "<b> <font color=red><br>* Invalid Email Address</font></b>";
						}else{}
					}
					?>

					<?php
					if(isset($_POST['Submit'])){
					$UserN = $_POST['Username'];
					$Pass = $_POST['Confirm'];
					$Mail = $_POST['Email'];
					$ConPass = $_POST['Password'];
					$Upper = preg_match('@[A-Z]@',$Pass);
					$Lower = preg_match('@[a-z]@', $Pass);
					$Number = preg_match('@[0-9]@', $Pass);
					$Chara = preg_match('@[^\w]@', $Pass);
					if(!$Upper || !$Lower || !$Number || !$Chara || strlen($Pass) <= 8 || $ConPass != $Pass || !filter_var($Mail, FILTER_VALIDATE_EMAIL)){
						}else{
						$Host = "localhost";
						$User = "root";
						$dbPass = "";
						$dbName = "sir_reboya";

						$con = mysqli_connect($Host, $User, $dbPass, $dbName) or die("failed to connect!");

						$UserN = $_POST['Username'];
						$Mail = $_POST['Email'];
						$_SESSION['Email'] = $Mail;

				        $select = "select * from sign_up where Username = '$UserN'";
				        $result = mysqli_query($con, $select);
				        $num = mysqli_num_rows($result);

				        if($num == 1){
			        		echo '<script>alert("Username already taken!")</script>';
				        }else{
						$insert_Query = "INSERT INTO sign_up (Username, Password, Email) VALUES ('$UserN','$Pass','$Mail')";
						if(mysqli_query($con,$insert_Query)){
						echo '<script>alert("Success")</script>';
						header( "Location: Homepage.php" );
						}else{
						echo "fail";
						}
						}
						}
					}
					?>
					</td>
				</tr>
			</table>
			<table align="center">
				<tr>
					<td align="center"><br><br><button class="LogButtons" name="Submit" type="submit">Sign Up</button></td>
				</tr>
				<tr>
					<td align="center"><br><button class="LogButtons" name="Submit" type="submit" onclick="document.location='Homepage.php'">Back</button></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</body>

<style>
	
	.Div1{
		width: 800px;
		height: 500px;
		position: fixed;
		border-radius: 35px;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.70);
	}
	.Picture{
		position: absolute;
		width: 150px;
		height: 500px;
		border-top-left-radius: 35px;
		border-bottom-left-radius: 35px;
	}
	.Picture2{
		float: right;
		width: 150px;
		height: 500px;
		border-top-right-radius: 35px;
		border-bottom-right-radius: 35px;
	}
	.Div2{
		margin: auto;
		background-color: white;
		width: 500px;
		height: 500px;
	}
	.welcome{
		background-color: #A44292;
		color: white;
	}
	.textbox{
	  	outline: 0;
		border-width: 0 0 2px;
	 	border-color: gray;
	 	font-size: 15px;
	}
	.LogButtons{
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
	.LogButtons:hover{
		background-color: #74326F;
	}

</style>

</html>