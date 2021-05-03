<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>Log In Page</title>
</head>
<body style="background-image: url(Purple3.jpg); background-size: cover;"><!-- Background -->


<!-- LOG IN CONTENTS -->
<form action="" method="post">
	<div class="Div1"  style="background-color: #A44292;"><!-- Box 1 na violet -->
	<img src="RandomPic.png" class="Picture"><!-- Box background pic -->
	<div class="Div2"><!-- Box white -->
	<table>
		<tr><td class="welcome" style="width: 200px;"><h3 style="text-align: center;">Welcome Back!</h3></td></tr>
	</table><br>
	<h3 style="text-align: center;">Log In Your Account</h3>
	<table border="0px;" width="345px">
		<tr>
			<td align="center"><input class="textbox" name="Username" type="text" placeholder="Username" size="30" required></td></tr>
		<tr>
			<td align="center"><br><input class="textbox" name="Password" type="Password" placeholder="Password" size="30" required></td></tr>
		<tr>
			<td align="center"><br><br><a href="ForgotPass.php">Forgot Password?</a></td></tr>
		<tr>
			<td align="center"><br><br><button class="LogButtons" name="Submit1" type="submit">Log In</button></td></tr>
		<tr>
			<td align="center"><br><button class="LogButtons" name="Submit" type="submit" onclick="document.location='SignUpPage.php'">Sign Up</button></td></tr>
	</table>
	</div>
	</div>
</form>



<!-- MODAL DB -->
<div id="Modaldb" class="modal">
    <div class="MContent">
    <div class="MHeader">
        <span class="Xbtn">&times;</span>
        <p>Verification</p>
    </div>
    <form action="Homepage.php" method="post">
    <div class="MBody">
      	<table>
        <tr>
      		<td><b>Authentication Code: </b></td>
      		<td><input type="text" name="code" placeholder="Enter Authentication Code"></td></tr>
        </table>
    </div>
    <div>
    	<table width="100%" cellspacing="0" cellpadding="0">
    	<tr>
      		<td><button name="Resendbtn" id="Resendbtn" class="Resendcls">Resend</button></td>
        	<td><button name="Submitbtn" id="Submitbtn"  class="Submitcls">Submit</button></td>
      	</tr>
    	</table>
    </div>
    </form>
    </div>
</div>

<script type="text/javascript">
	var modal = document.getElementById("Modaldb");
	var span = document.getElementsByClassName("Xbtn")[0];
	var button = document.getElementById("sub");
	span.onclick = function() {
	   modal.style.display = "none";
	}
	window.onclick = function(event) {
	  if (event.target == modal) {
	     modal.style.display = "none";
	  }
	}
</script>



<!-- PHP FUNCTIONS-->
<?php 
//SUBMIT BUTTON
if(isset($_POST['Submit1'])){
	$Host = "localhost";
	$User = "root";
	$DBpass = "";
	$DBname = "sir_reboya";

	$con = mysqli_connect($Host, $User, $DBpass, $DBname) or die("Connection Failed");

	$UserN = $_POST['Username'];
    $Pass = $_POST['Password'];
	$Select = "SELECT * FROM sign_up WHERE Username = '$UserN'";
    $Select1 = "SELECT * FROM sign_up WHERE Password = '$Pass'";
    $result = mysqli_query($con, $Select);
    $result1 = mysqli_query($con, $Select1);
    $num = mysqli_num_rows($result);
    $num1 = mysqli_num_rows($result1);

    if ($UserN ==  "Admin" && $Pass == "Admin.123") {
		date_default_timezone_set('Asia/Taipei');
		$time = date("Y-m-d H:i:s");
		$act = "LOGIN";
    	$Loginevent = mysqli_query($con, "INSERT INTO event_log (Activity, Username, Date_Time) VALUES ('$act', 'Admin', '$time')");
			$_SESSION['UserN'] = $UserN;
    	header("location:Admin.php");
    }

	elseif ($num == 1){//IF tama ang Username
		if($num1 == 1){//IF tama ang Password
			$Code = rand(100000,999999);
			$UserN = $_POST['Username'];
			$UserNquery = "SELECT NumberID FROM sign_up WHERE Username = '$UserN'";
			$result = mysqli_query($con, $UserNquery);
			date_default_timezone_set('Asia/Taipei');
			$time = date("Y-m-d H:i:s");
			$CurrentDate = strtotime($time);
			$ExpirationDate = $CurrentDate+(60*5);
			$OutputDate = date("Y-m-d H:i:s", $ExpirationDate);
			$act = "LOGIN";

			$Loginevent = mysqli_query($con, "INSERT INTO event_log (Activity, Username, Date_Time) VALUES ('$act', '$UserN', '$time')");
			$_SESSION['UserN'] = $UserN;

			$InsertCode = "INSERT INTO auhentication_code (UserID, RandomCode, Created, Expiration) SELECT NumberID, '$Code', '$time', '$OutputDate' FROM sign_up WHERE Username = '$UserN'";
			$result1 = mysqli_query($con, $InsertCode);
			echo '<script>alert("Code: '.$Code.'");
       			modal.style.display = "block";
        		</script>';
		}
		else{//IF mali Password
			echo '<script>alert("Wrong Password")</script>';
		}
	}

	else{//IF mali ang Username
		if ($num1 == 1) {//IF maali ang Password
			echo '<script>alert("Wrong Username")</script>';
		}
		else{//IF tama ang Password
			echo '<script>alert("Log In Failed")</script>';
		}
	}
}



//SUBMIT AUTHENTICATION CODE
if(isset($_POST['Submitbtn'])){
	$Host = "localhost";
	$User = "root";
	$DBpass = "";
	$DBname = "sir_reboya";

	$con = mysqli_connect($Host, $User, $DBpass, $DBname) or die("Connection Failed");

	$Code=$_POST['code'];
	$GetCode = "SELECT * FROM auhentication_code WHERE RandomCode = '$Code'";
	$Coderes = mysqli_query($con,$GetCode);
	$num = mysqli_num_rows($Coderes);
	$GetExpiration = "SELECT Expiration FROM auhentication_code WHERE RandomCode = '$Code'";
	$Expres = mysqli_query($con,$GetExpiration);
	$num2 = mysqli_fetch_assoc($Expres);
	if($num>0){
	    $CurrentTime = date("Y-m-d h:i:s");
	    $Today = strtotime($CurrentTime);
	    $exp = strtotime($num2['Expiration']);
	    $Diff = $exp - $Today;
	    $minuto = $Diff / 60;
	    if($minuto>=0 ){
	    	$UserN = $_SESSION['UserN'];
			date_default_timezone_set('Asia/Taipei');
			$time = date("Y-m-d H:i:s");
	    	$act = "LOGIN SUCCESS";
			$Loginevent = mysqli_query($con, "INSERT INTO event_log (Activity, Username, Date_Time) VALUES ('$act', '$UserN', '$time')");
	       	echo'<script>window.alert("Login Successful");</script>';
	       	header("Location:MEME.php");
	    }
	    else{
	      	echo'<script>window.alert("Code Expired");
	      	modal.style.display="block";
			</script>';
	    }
	}
}



//RESEND AUTHENTICATION CODE
if(isset($_POST['Resendbtn'])){
	$Host = "localhost";
	$User = "root";
	$DBpass = "";
	$DBname = "sir_reboya";

	$con = mysqli_connect($Host, $User, $DBpass, $DBname) or die("Connection Failed");

	$NewCode=rand(100000,999999);
	$MemaID = "SELECT * FROM auhentication_code ORDER BY ID DESC LIMIT 1";
	$Coderes = mysqli_query($con,$MemaID);
	$Fetch = mysqli_fetch_assoc($Coderes);
	$NewID = $Fetch['UserID'];
	$NewTime = date("Y-m-d h:i:s");
	$NewCurrentDate = strtotime($NewTime);
	$NewExpDate = $NewCurrentDate+(60*5);
	$NewOutput = date("Y-m-d h:i:s", $NewExpDate);
	$NewInsert = "INSERT INTO auhentication_code (UserID, RandomCode, Created, Expiration) SELECT '$NewID', '$NewCode', '$NewTime', '$NewOutput'";
	$nresult1 = mysqli_query($con, $NewInsert);
	//Maga-alert ung code
	echo '<script>alert("New Code: '.$NewCode.'" );
		modal.style.display = "block"
		</script>';
}
//END PHP FUNCTIONS
?>



</body>
<style>



/* Div na Violet */
.Div1{
	width: 800px;
	height: 500px;
	position: fixed;
	border-radius: 35px;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.70);
}/* Div picture na waves */
.Picture{
	position: absolute;
	width: 455px;
	height: 500px;
	border-top-left-radius: 35px;
	border-bottom-left-radius: 35px;
}/* Div na white*/
.Div2{
	float: right;
	background-color: white;
	border-top-right-radius: 35px;
	border-bottom-right-radius: 35px;
	width: 345px;
	height: 500px;
}/* Welcome text*/
.welcome{
	background-color: #A44292;
	color: white;
	border-top-right-radius: 35px;
	border-bottom-right-radius: 35px;
}/* Mga textbox bruh */
.textbox{
  	outline: 0;
	border-width: 0 0 2px;
 	border-color: gray;
 	font-size: 15px;
}/* Log in & Sign Up Buttons */
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
}/* Log & Sign hover */
.LogButtons:hover{
	background-color: #74326F;
}

/* MODAL STUFF//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */

/* Modal opacity and bg */
.modal{
	display: none;
	position: fixed;
	z-index: 1;
	left: 0;
	top: 0%;
	width: 100%;
	height: 100%;
	overflow: auto;
	background-color: rgb(0,0,0);
	background-color: rgba(0,0,0,0.8);
}/* X Button */
.Xbtn{
	color: white;
	float: right;
	font-size: 28px;
	font-weight: bold;
}/* X Button hover effect*/
.Xbtn:hover, .Xbtn:focus{
	color: red;
	text-decoration: none;
	cursor: pointer;
	transition: 0.3s;
}/* Modal Header */
.MHeader {
	padding: 2px 16px;
	background-color: #A44292;
	font-family: arial;
	color: white;
	border-top-right-radius: 20px;
	border-top-left-radius: 20px;
}/* Modal Body */
.MBody {
	padding: 3%;
	background-color: white;
	color: black;
}/* Modal Resend Button */
.Resendcls{
	width: 100%;
	height: 40px;
	cursor: pointer;
	border: none;
	outline: none;
	color: black;
	font-size: 16px;
	background: white;
	border-bottom-left-radius: 20px;
}/* Modal Submit Button */
.Submitcls{
	width: 100%;
	height: 40px;
	cursor: pointer;
	border: none;
	outline: none;
	color: black;
	font-size: 16px;
	background: white;
	border-bottom-right-radius: 20px;
}/* ResSub Button Effects */
.Resendcls:hover, .Submitcls:hover{
       background: #A44292;
       color: white;
       transition: 0.3s;
}/* Modal Content */
.MContent {
  position: relative;
  margin: auto;
  padding: 0;
  box-shadow: 100px red;
  width: 30%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  animation-name: animatetop;
  animation-duration: 0.6s;
  margin-top: 17%;
}/* Add Animation */
@keyframes animatetop{
  from {top: -300px; opacity: 0}
  to {top: 0; opacity: 1}
}
.MBody input { 
  width: 95%; 
  margin-bottom: 10px; 
  background: rgba(130,130,100,0.3);
  border: none;
  outline: none;
  padding: 10px;
  font-size: 13px;
  color: white;
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  margin-top: 10px;
  margin-left: 2%;
}



</style>
</html>