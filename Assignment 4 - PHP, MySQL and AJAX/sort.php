<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['val'])) {

	$val = $_POST['val'];
	
	if(!empty($val)) {

		if($val == "A") {
			$_SESSION['sort'] = "NAME ASC";
			echo "yes";
		}

		else if($val == "Z") {
			$_SESSION['sort'] = "NAME DESC";
			echo "yes";
		}

		else if($val == "R") {
			$_SESSION['sort'] = "ID DESC";
			echo "yes";
		}

	}

}

?>