<?php

if(isset($_GET['search']) && isset($_GET['searchcat'])) {

	$search = $_GET['search'];
	$cat = $_GET['searchcat'];
	$_SESSION['search'] = $search;
	$_SESSION['searchcat'] = $cat;

	if(!empty($search) && !empty($cat)) {

		if($cat == "A") {
			$sqlquery = "SELECT DISTINCT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(NAME) LIKE UPPER('%$search%') OR UPPER(AUTHOR) LIKE UPPER('%$search%')";
		}

		else if($cat == "B") {
			$sqlquery = "SELECT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(NAME) LIKE UPPER('%$search%')";
		}

		else if($cat == "C") {
			$sqlquery = "SELECT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(AUTHOR) LIKE UPPER('%$search%')";
		}
	}
}

else {
	$search = $_SESSION['search'];
	$cat = $_SESSION['searchcat'];

	if(!empty($search) && !empty($cat)) {

		if($cat == "A") {
			$sqlquery = "SELECT DISTINCT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(NAME) LIKE UPPER('%$search%') OR UPPER(AUTHOR) LIKE UPPER('%$search%')";
		}

		else if($cat == "B") {
			$sqlquery = "SELECT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(NAME) LIKE UPPER('%$search%')";
		}

		else if($cat == "C") {
			$sqlquery = "SELECT ID, NAME, AUTHOR, ISSUED FROM BOOKS WHERE UPPER(AUTHOR) LIKE UPPER('%$search%')";
		}
	}

}

?>

<!DOCTYPE html>

<html>

<head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<meta charset="utf-8">
  	
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />

	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<title> Library Portal </title>

	<style type="text/css">

		body {
			margin: 0;
		    background-size:cover;
			background-attachment: fixed;
		    background-repeat: no-repeat;
		    background-image: url('bg.jpg');
		    overflow-x: hidden;
			font-family: 'Roboto', sans-serif;
			color: white;
		}

		#top {
			width: 100%;
			height: 20vh;
			background: rgba(0,0,0,0.5);
			position: absolute;
			top: 0;
			color: white;
		}

		#welcometext {
			color: white;
			font-size: 1.7em;
			position: relative;
			top: 23vh;
			margin: auto;
			width: 75%;
			text-align: center;
			background: rgba(0,0,0,0.7);
			padding-top: 2vh;
			padding-bottom: 2vh;
			border-radius: 2vh;
			font-weight: bold;
		}

		#welcometext span {
			font-size: 2.5em;
			color: #ff3300;
		}

		#logout {
			position: absolute;
			top: 7vh;
			right: 6vw;
			height: 5vh;
			min-width: 6vw;
			background: #ff3300;
			border: none;
			outline: none;
			border-radius: 0.3vw;
			display: block;
			color: black;
			border-width: 0;
			font-weight: bold;
			font-family: 'Roboto', sans-serif;
			font-size: 0.8vw;
		}

		button {
			font-weight: bold;
			font-family: 'Roboto', sans-serif;
			font-size: 0.8vw;
		}

		@keyframes underline {
		    from {width: 0;}
		    to {width: max-width;}
		}

		#logo {
			max-height: 17vh;
			position: absolute;
			top: 1vh;
			left: 2.5vw;
		}

		#popup {
			background-color: #ff3300;
			width: 25%;
			height: 7%;
			position: absolute;
			top: 21.5vh;
			left: 37.5vw;
			border-radius: 3.5vh;
			text-align: center;
			font-family: "Roboto", sans-serif;
			font-size: 2.5vh;
			color: black;
			font-weight: bold;
		}

		#popup span {
			position: absolute;
			top: 2vh;
			left: 4vh;
		}

		#popup img {
			max-height: 2vh;
			position: absolute;
			top: 2.5vh;
			right: 3.5vh;
			cursor: pointer;
		}

		#mybooks {
			height: 12vh;
			width: 4.8vw;
			background-color: transparent;
			position: absolute;
			top: 4vh;
			right: 18vw;
			text-align: center;
		}

		#mybooks img {
			max-height: 12vh;
		}

		#mybooks label {
			font-family: 'Roboto', sans-serif;
			font-size: 0.9em;
			color: black;
			font-weight: bold;
			position: absolute;
			top: 2vh;
			left: 1vw;
			cursor: pointer;
		}

		#searchbox {
			position: absolute;
			background-color: yellow;
			width: 40%;
			height: 6vh;
			top: 5vh;
			left: 30vw;
			margin: none;
			border-radius: 0.5vh;
			background-color: rgba(0,0,0,0.7);
		}

		#searchbutton {
			max-height: 4vh;
			position: absolute;
			top: 1vh;
			right: 0.5vw;
		}

		#search {
			margin: 0;
			border: none;
			height: 6vh;
			position: absolute;
			bottom: 0;
			left: 0.7vw;
			font-size: 1em;
			padding: 0;
			width: 90%;
			background-color: transparent;
			color: white;
		}

		#search:focus {
			outline: none;
		}

		#searchcat {
			font-size: 0.9em;
			position: absolute;
			top: 13vh;
			left: 39vw;
		}

		#optall {
			position: absolute;
			top: 13vh;
			left: 45vw;
		}

		#optbooks {
			position: absolute;
			top: 13vh;
			left: 49vw;
		}

		#optauthor {
			position: absolute;
			top: 13vh;
			left: 55vw;
		}

	</style>

</head>

<body>

	<div id="top">
	
		<a href="index.php"><img src="logo.png" id="logo"></a>

		<div id="mybooks">
			<a href="addedbyme.php"><img id="bookimg" src="book.png">
			<label>ADDED<br>BY ME</label></a>
		</div>

		<form method="GET" action="search.php">

		<div id="searchbox">
			<input type="text" name="search" id="search" placeholder="Search">
			<input type="image" src="search.png" id="searchbutton" alt="Submit">
		</div>

		<label id="searchcat">Search by:</label>

		<label id="optall">
			<input type="radio" name="searchcat" value="A" class="radio" required checked="checked"> All
		</label> 
		<label id="optbooks">
			<input type="radio" name="searchcat" value="B" class="radio" required> Books
		</label> 
		<label id="optauthor">
			<input type="radio" name="searchcat" value="C" class="radio" required> Author
		</label>

		</form>

		<form action="logout.php">
			<button type="submit" id="logout" style="cursor: pointer">LOG OUT</button>
		</form>

	</div>

	<div id="welcometext">
		<span>Search Results</span><br><br>LIST OF BOOKS

	</div>

	<?php

	$query = $conn->prepare($sqlquery);
	$query->execute();
		
	if($query->rowCount()==0) {
		echo "<div id=\"nb\" style='background-color: rgba(0,0,0,0.7);width: 75%; font-size: 7em; color: white; position:absolute; text-align: center; border-radius: 2vh; top: 53vh; left: 12.5vw;'>No Books Found</div>";
		echo "<table id='booktable' style = '
								font-size: 2em;
								width: 75%;
								position: absolute;
								top: 50vh;
								left: 12.5vw;
								color: white;
								background-color: transparent;
								border-radius: 2vh;
								margin-bottom: 10vh;
			'>";
		echo "<tr></tr></table>";
	}
		
	else {

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
				
		echo "<table id='booktable' style = '
								font-size: 2em;
								width: 75%;
								position: absolute;
								top: 50vh;
								left: 12.5vw;
								color: white;
								background-color: rgba(0,0,0,0.7);
								border-radius: 2vh;
								margin-bottom: 10vh;
			'>";

		for($index = 0; $index < $query->rowCount() ; $index++) {

			$name = $result[$index]['NAME'];
			$author = $result[$index]['AUTHOR'];
			$id = $result[$index]['ID'];
			$issued = $result[$index]['ISSUED'];

			$removeimg = "<img src=\"remove.png\" onmouseenter = \"$(this).attr('src','removehover.png')\" onmouseleave = \"$(this).attr('src','remove.png')\"  style=\"max-height: 4vh; position: relative; top: 1.5vh; cursor: pointer;\" onclick=\"removebook('".$id."','".$issued."')\">";
			$removeimgl = "<img src=\"remove.png\" onmouseenter = \"$(this).attr('src','removehover.png')\" onmouseleave = \"$(this).attr('src','remove.png')\"  style=\"max-height: 4vh; position: relative; top: 1vh; cursor: pointer;\" onclick=\"removebook('".$id."','".$issued."')\">";

			if($index == $query->rowCount() - 1) {
				echo "<tr id=\"book".$id."\">";
				echo "<td style = 'padding: 1.5vh 2vw 2vh 2vw'><b>$name</b> <span style = 'font-size: 0.77em'><i>by</i> &nbsp<b>$author</b> </span> </td>";
    			echo "<td style = 'text-align: right; padding-right: 2vw'>".$removeimgl."</td>";
  				echo "</tr>";
			}

			else if($index == 0) {
				echo "<tr id=\"book".$id."\">";
				echo "<td style = 'padding: 2vh 2vw 0.5vh 2vw'><b>$name</b> <span style = 'font-size: 0.77em'><i>by</i> &nbsp<b>$author</b> </span> </td>";
    			echo "<td style = 'text-align: right; padding-right: 2vw'>".$removeimg."</td>";
  				echo "</tr>";
			}

			else {
				echo "<tr id=\"book".$id."\">";
				echo "<td style = 'padding: 1.5vh 2vw 0.5vh 2vw'><b>$name</b> <span style = 'font-size: 0.77em'><i>by</i> &nbsp<b>$author</b> </span> </td>";
    			echo "<td style = 'text-align: right; padding-right: 2vw'>".$removeimg."</td>";
  				echo "</tr>";
			}

		}

		echo "</table>";

	}

	?>

	<div id="popup" style="display: none"><span>Book added successfully</span><img src="closepop.png" onclick="popuprem()"></div>

	<div id="nobooks" style='background-color: rgba(0,0,0,0.7);width: 75%; font-size: 7em; color: white; position:absolute; text-align: center; border-radius: 2vh; top: 53vh; left: 12.5vw;display: none'>No Books Found</div>

	<script type="text/javascript">

		function popuprem() {
			$('#popup').slideUp(700);
			$("#welcometext").animate({top: "-=7vh"}, 700);
			$("#booktable").animate({top: "-=7vh"}, 700);
			$("#nobooks").animate({top: "-=7vh"}, 700);
		}

		function popupdisp() {
			if(document.getElementById('popup').style.display == "block") return false;
			else return true;
		}

		function update(bid, msg) {

			if(msg == "remsuccess") {
				
				var rowid = "#book"+bid;
				document.getElementById('popup').innerHTML = "<span>Book removed successfully</span><img src=\"closepop.png\" onclick=\"popuprem()\">"
				$(rowid).fadeOut(500, function() { 
					if(document.getElementById('booktable').innerHTML == "<tbody></tbody>") {
						$('#nobooks').fadeIn(500);
					}
					$(this).remove();
					$('#popup').slideDown(700);
					if(popupdisp()) {
						$("#welcometext").animate({top: "+=7vh"}, 700);
						$("#booktable").animate({top: "+=7vh"}, 700);
						$("#nobooks").animate({top: "60vh"}, 700);
						document.getElementById('popup').style.display = "block";
					}

					if(document.getElementById('booktable').innerHTML == "<tbody><tr style=\"padding-top: 2vh; padding-bottom: 2vh;\"></tr></tbody>") {
						document.getElementById('booktable').style.backgroundColor = "transparent";
						$('#nobooks').fadeIn(500);
					}
				});
				$('#booktable tr:last').animate({ paddingBottom: '2vh' }, 0);

			}
			else if(msg == "remerror") {
				document.getElementById('popup').innerHTML = "<span>Book cannot be removed</span><img src=\"closepop.png\" onclick=\"popuprem()\">"
				$('#popup').slideDown(700);
				if(popupdisp()) {
					$("#welcometext").animate({top: "+=7vh"}, 700);
					$("#booktable").animate({top: "+=7vh"}, 700);
					$("#nobooks").animate({top: "60vh"}, 700);
					document.getElementById('popup').style.display = "block";
				}
			}
		}

		function removebook(id, issued) {

			var arg = "id="+id+"&issued="+issued;
			if (window.XMLHttpRequest) {
    			xmlhttp = new XMLHttpRequest();
 			}
			else {
	       		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					update(id, this.responseText);
				}
			}

			xmlhttp.open("POST", "removebook.php", true);
			xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlhttp.send(arg);
		}

		$('#searchbutton').mouseenter(function() {
  			$(this).attr('src','searchhover.png');
  		});
  		$('#searchbutton').mouseleave(function() {
  			$(this).attr('src','search.png');
  		});

	</script>

</body>

</html>