<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(loggedin() && $_SESSION['ac'] == 'A') {
	include 'adminindex.php';
}

else if(loggedin() && $_SESSION['ac'] == 'U') {
	include 'userindex.php';
}

else {
	include 'newuser.php';
}	

?>