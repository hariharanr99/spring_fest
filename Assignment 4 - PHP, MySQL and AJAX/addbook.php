<?php

require 'core.inc.php';
require 'sqlconnect.php';

if(isset($_POST['bookname']) && isset($_POST['author'])) {

	$book = $_POST['bookname'];
	$author = $_POST['author'];

	if(!empty($book) && !empty($author)) {

		if(strpos($book,"'")) {
			$arr = explode("'",$book);
			$book = implode("''",$arr);
		}

		if(strpos($author,"'")) {
			$arr = explode("'",$author);
			$author = implode("''",$arr);
		}

		$query = $conn->prepare("SELECT NAME, AUTHOR FROM BOOKS WHERE NAME = '$book' AND AUTHOR = '$author'");
		$query->execute();

		if($query->rowCount() == 1) {
			echo "adderror";
		}

		else {
			$user = $_SESSION['user_id'];
			$query = $conn->prepare("INSERT INTO BOOKS VALUES('', '$book', '$author', 'N', '', '$user')");
			$query->execute();
			$query = $conn->prepare("SELECT ID FROM BOOKS WHERE NAME = '$book' AND AUTHOR = '$author'");
			$query->execute();
			$id = $query->fetch(PDO::FETCH_ASSOC)['ID'];
			if(strpos($book,"''")) {
				$arr = explode("''",$book);
				$book = implode("'",$arr);
			}

			if(strpos($author,"''")) {
				$arr = explode("''",$author);
				$author = implode("'",$arr);
			}
			echo $id.";".$book.";".$author.";addsuccess";
		}

	}

}

?>