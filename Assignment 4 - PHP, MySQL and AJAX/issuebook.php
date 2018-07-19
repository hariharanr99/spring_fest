<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['bookid'])) {

	$book = $_POST['bookid'];
	$user = $_SESSION['user_id'];

	if(!empty($book)) {

		$query = $conn->prepare("SELECT ISSUED FROM BOOKS WHERE ID = '$book'");
		$query->execute();
				
		$result = $query->fetch(PDO::FETCH_ASSOC);
				
		$bid = $result['ISSUED'];

		if($bid == "N") {
			$query = $conn->prepare("UPDATE BOOKS SET ISSUED = 'Y', ISSUEDTO = '$user' WHERE ID = '$book'");
			$query->execute();
			echo "issuesuccess";
		}

		else if($query->rowCount()==0) {
			echo $book.";issueerror";
		}

		else if($bid == "Y") {
			echo "issuedalready";
		}

	}

}

?>