<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(loggedin() && $_SESSION['ac'] == 'A') {
	include 'adminsearch.php';
}

else if(loggedin() && $_SESSION['ac'] == 'U') {
	include 'usersearch.php';
}

else {
	include 'nusearch.php';
}	

?>