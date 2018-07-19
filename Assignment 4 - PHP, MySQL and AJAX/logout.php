<?php

require 'core.inc.php';
session_destroy();

setcookie('user', "", time() - 86400 );

if(strpos($http_referer,"search")) {
	$arr = explode("=", $http_referer);
	$search = explode("&",$arr[1])[0];
	$cat = $arr[4];
	header("Location: ".$http_referer);
}

else {
	header('Location: index.php');
}

?>