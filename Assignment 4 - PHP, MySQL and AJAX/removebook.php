<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['id']) && isset($_POST['issued'])) {

	$id = $_POST['id'];
	$issued = $_POST['issued'];

	if(!empty($id) && !empty($issued)) {

		if($issued == 'Y') {
			echo "remerror";
		}
		
		else {
			$query = $conn->prepare("DELETE FROM BOOKS WHERE ID = '$id'");
			$query->execute();
			echo "remsuccess";
		}

	}

}

?>