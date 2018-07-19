<?php

require 'sqlconnect.php';

$arr = explode(";",$_COOKIE['user']);
$username = $arr[0];
$password_hash = $arr[1];

$query = $conn->prepare("SELECT ID, NAME, ACCTYPE FROM USERACCOUNTS WHERE USERNAME = '$username' AND PASSWORD = '$password_hash'");
$query->execute();
				
$result = $query->fetch(PDO::FETCH_ASSOC);
		
$_SESSION['user_id'] = $result['ID'];
$_SESSION['name'] = $result['NAME'];
$_SESSION['ac'] = $result['ACCTYPE'];

?>