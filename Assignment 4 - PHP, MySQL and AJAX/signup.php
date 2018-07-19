<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($http_referer) && $http_referer == "https://libraryportal.000webhostapp.com/login.php") echo "<script type='text/javascript'>alert('Register First!');</script>";

if(isset($_POST['name']) && isset($_POST['emailid']) && isset($_POST['dob']) && isset($_POST['gender']) && isset($_POST['username']) && isset($_POST['acc']) && isset($_POST['pass']) && isset($_POST['cpass'])) {

	$name = $_POST['name'];
	$emailid = $_POST['emailid'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$username = $_POST['username'];
	$actype = $_POST['acc'];
	$password = $_POST['pass'];
	$cpassword = $_POST['cpass'];

	if(!empty($name) && !empty($emailid) && !empty($dob) && !empty($gender) && !empty($username) && !empty($actype) && !empty($password) && !empty($cpassword)){

		if(strlen($name) <= 50 && strlen($username) <= 30) {

			$query1 = $conn->prepare("SELECT EMAIL FROM USERACCOUNTS WHERE EMAIL = '$emailid' AND ACCTYPE = '$actype'");
			$query1->execute();
			$query2 = $conn->prepare("SELECT USERNAME FROM USERACCOUNTS WHERE USERNAME = '$username'");
			$query2->execute();
			
			if($query1->rowCount()==1) {
				echo "<p style=\"position: absolute; top: 80vh; left: 40vw;font-family: \'Roboto\', sans-serif; font-size: 1em; z-index: +5; color: #ff3300;\">You have already registered. Please Log in.</p>";
			}

			else if($query2->rowCount()==1) {
				echo "<p style=\"position: absolute; top: 80vh; left: 42vw;font-family: \'Roboto\', sans-serif; font-size: 1em; z-index: +5; color: #ff3300;\">Sorry. Username already taken.</p>";
			}

			else if($password != $cpassword) {
				echo "<p style=\"position: absolute; top: 80vh; left: 43vw;font-family: \'Roboto\', sans-serif; font-size: 1em; z-index: +5; color: #ff3300;\">Passwords do not match</p>";
			}

			else {

				$password_hash = md5($password);

				$query = $conn->prepare("INSERT INTO USERACCOUNTS VALUES('', '$name', '$emailid', '$dob', '$gender', '$username', '$password_hash', '$actype')");
				$query->execute();

				$query = $conn->prepare("SELECT ID, NAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND PASSWORD = '$password_hash'");
				$query->execute();
				$result = $query->fetch(PDO::FETCH_ASSOC);

				$_SESSION['user_id'] = $result['ID'];
				$_SESSION['name'] = $result['NAME'];
				$_SESSION['ac'] = $result['ACCTYPE'];
					
				$regnow = true;

				header('Location: index.php');

			}
		}
	}
}

?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">
  	
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />

	<link rel="stylesheet" type="text/css" href="styles.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<title> Sign Up </title>

	<style type="text/css">

			.page {
				top: 11%;
				left: 30%;
				height: 77%;
				width: 40%;
				overflow: hidden;
			}

			.head {
				width: 32.5vw;
				position: absolute;
				top: 7vh;
			}

			.textbox {
				margin-bottom: 6vh;
				padding-bottom: 1vh;
			}

			#signupbutton {
				position: absolute;
				top: 63vh;
				left: 3.5vw;
				margin-bottom: 10vw;
				cursor: pointer;
			}

			#login {
				position: absolute;
				top: 63.5vh;
				left: 28vw;
			}
 
			#namel {
				position: absolute;
				top: 15vh;
				left: 3.5vw;
			}

			#name {
				position: absolute;
				top: 16vh;
				left: 3.25vw;
				width: 14.5vw;
			}

			#emailid {
				position: absolute;
				top: 16vh;
				left: 20.75vw;
				width: 14.5vw;
			}

			#emailidl {
				position: absolute;
				left: 21vw;
				top: 15vh;
			}

			#dob {
				position: absolute;
				top: 25.5vh;
				left: 3.5vw;
			}

			#gender {
				position: absolute;
				top: 25.5vh;
				left: 21vw;
			}

			#actype {
				position: absolute;
				top: 36vh;
				left: 21vw;
			}

			#user {
				position: absolute;
				top: 40.5vh;
				left: 21vw;
			}

			#admin {
				top: 40.5vh;
				left: 26vw;
			}

			#male {
				left: 21vw;
				top: 30vh;
			}

			#female {
				left: 26vw;
				top: 30vh;
			}
		
			#other {
				left: 32vw;
				top: 30vh;
			}

			#userlabel {
				position: absolute;
				top: 36.5vh;
				left: 3.5vw;
			}

			#username {
				position: absolute;
				top: 38vh;
				left: 3.25vw;
				padding-bottom: 0.1vw;
				width: 14.5vw;
			}

			#passwordinf {
				position: absolute;
				top: 56vh;
				font-size: 0.75vw;
				margin-right: 3.5vw;
				text-align: left;
			}	

			#passwordl {
				position: absolute;
				top: 46.5vh;
				left: 3.5vw;
			}

			#cpasswordl {
				position: absolute;
				top: 46.5vh;
				left: 21vw;
			}

			#password {
				position: absolute;
				top: 47.5vh;
				left: 3.25vw;
				width: 14.5vw;
			}

			#cpassword {
				position: absolute;
				top: 47.5vh;
				left: 20.75vw;
				width: 14.5vw;
			}

			#bday {
				position: absolute;
				top: 30vh;
				left: 3.25vw;
				width: 15.5vw;
				border: none;
				font-family: 'Roboto', sans-serif;
				font-size: 1vw;
				border-bottom: 0.1vw solid  rgba(0,0,0,0.25);
			}

			#bday:focus {
				outline: none;
				border-bottom: 0.15vw solid  #ff3300;
				animation: underline;
				animation-duration: 0.3s;
				color: black;
			}

	</style>

</head>

<body>

	<div id="loginpage" class="page">

		<form method="POST" action="<?php echo $current_file; ?>">
			
			<label class="head"> Sign up </label>
			<label for="name" id="namel"> Name </label>
			<input type="text" id="name" name="name"required class="textbox" maxlength="50">
			<label id="emailidl"> Email-Id </label>
			<input type="email" id="emailid" name="emailid" required class="textbox" maxlength="40">
			<label id="dob"> Your Birthday </label>
			<input type="date" id="bday" name="dob">
  			<label id="gender" required> Gender </label>
  			<label id="male">
				<input type="radio" name="gender" value="M" class="radio" required> Male
			</label> 
			<label id="female">
				<input type="radio" name="gender" value="F" class="radio" required> Female
			</label> 
			<label id="other">
				<input type="radio" name="gender" value="O" class="radio" required> Other
			</label>
			<label id="actype" required> Type of Account </label>
  			<label id="admin">
				<input type="radio" name="acc" class="radio" value="A" required> Admin
			</label> 
			<label id="user">
				<input type="radio" name="acc" class="radio" value="U" required> User
			</label> 
			<label for="username" id="userlabel"> Username </label>
			<input type="text" id="username" name="username" required class="textbox" maxlength="30" style="text-transform:lowercase">
			<label id="passwordl"> Password </label>
			<label id="passwordinf"> Password must contain 8 or more characters and contain at least one number and both uppercase and lowercase letter </label>
			<input type="password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="password" required class="textbox">
			<label id="cpasswordl"> Confirm Password </label>
			<input type="password" name="cpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" id="cpassword" required class="textbox">
			<button type="submit" id="signupbutton">SIGN UP</button>
      		<label id="login"><a href="login.php">Registered? Log In</a></label>
		</form>

	</div>

</body>

</html>