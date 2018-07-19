<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['bookid'])) {

	$book = $_POST['bookid'];

	if(!empty($book)) {

		$query = $conn->prepare("UPDATE BOOKS SET ISSUED = 'N', ISSUEDTO = '' WHERE ID = '$book'");
		if($query->execute()) {
			echo "returnsuccess";
		}

		else {
			echo "returnerror";
		}

	}

}

?>