<?php 

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['username']) && isset($_POST['password'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	if(isset($_POST['remember']))$rem = $_POST['remember'];
	else $rem = "off";
	$password_hash = md5($password);

	if(!empty($username) && !empty($password)) {

		$query = $conn->prepare("SELECT USERNAME FROM USERACCOUNTS WHERE USERNAME = '$username'");
		$query->execute();
		
		if($query->rowCount()==0) header('Location: signup.php');
		
		else {

			$query = $conn->prepare("SELECT ID, NAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND PASSWORD = '$password_hash'");
			$query->execute();
				
			if($query->rowCount()==0) echo "<p style=\"color:rgb(204,0,0);font-family: 'Roboto', sans-serif;font-size: 0.77em;position:absolute;top: 50vh;left: 38.5vw;z-index: 10\">Wrong password. Try again or click Forgot password to reset it.</p>";
			else {

				$result = $query->fetch(PDO::FETCH_ASSOC);
				
				$_SESSION['user_id'] = $result['ID'];
				$_SESSION['name'] = $result['NAME'];
				$_SESSION['ac'] = $result['ACCTYPE'];

				if($rem == "on") {
					setcookie('user', $_SESSION['name'].";".$password_hash, time() + 86400 );
				}
				else if($rem == "off") {
					setcookie('user', '', time() - 86400 );					
				}				
				
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

	<title> Login </title>

	<style type="text/css">

			#usernamel {
				position: absolute;
				top: 17vh;
				left: 3.5vw;
			}

			#username {
				position: absolute;
				top: 20vh;
				left: 3.25vw;
			}

			#pwdl {
				position: absolute;
				top: 30vh;
				left: 3.5vw
			}

			#pwd {
				position: absolute;
				top: 33vh;
				left: 3.25vw;
			}

			#remember {
				position: absolute;
				top: 45vh;
				left: 3.25vw;
			}

			#loginbutton {
				position: absolute;
				top: 52.5vh;
				left: 3.25vw;
				cursor: pointer;
			}

			#forgotpass {
				position: absolute;
				top: 53vh;
				left: 18.5vw;
			}

			#signup {
				position: absolute;
				top: 62.5vh;
				left: 9vw;
			}

	</style>

</head>

<body>

	<div id="loginpage" class="page">

		<form method="POST" action="<?php echo $current_file; ?>">
			<label class="head"> Log in </label><span> </span>  
			<label for="username" id="usernamel"> Username </label>  
			<input type="text" name="username" id="username" required="true" class="textbox">  
			<label for="password" id="pwdl"> Password </label>  
			<input type="password" name="password" id="pwd" required="true" class="textbox">  
			<label id="remember" >
        		<input type="checkbox" checked="checked" name="remember" class="checkbox"> Remember me
      		</label>
      		<button type="submit" id="loginbutton">LOGIN</button>
      		<label id="forgotpass"><a href="">Forgot Password?</a></label>
      		<label id="signup"><a href="signup.php">Not Registered Yet? Sign Up</a></label>
		</form>

	</div>

	<script type="text/javascript">
		$('#checkArray:checkbox:checked').length 
	</script>

</body>

</html>