<?php

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
	@$http_referer = $_SERVER['HTTP_REFERER'];
	
	if($http_referer != "https://libraryportal.000webhostapp.com/index.php"){
		$_SESSION['sort'] = "ID DESC";
	}
}

if(!isset($_SESSION['sort']) || empty($_SESSION['sort'])) $_SESSION['sort'] = "ID DESC";
$sort = $_SESSION['sort'];

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

		#addbook {
			width: 100%;
			height: 100%;
			background: rgb(17,17,17);
			position: fixed;
			top: 0;
			left: 0;
			font-family: 'Roboto', sans-serif;
			font-size: 4em;
			z-index: 5;
			display: none;
		}

		#addbook img {
			max-height: 5vh;
			position: absolute;
			top: 4vh;
			right: 4vh;
			cursor: pointer;
		}

		#addbook label {
			color: #ff3300;
		}

		#addbook input {
			border-width: 0;
			border-bottom: 0.2vw solid rgb(150,150,150);
			max-width: 85%;
			width: 60%;
			font-family: 'Roboto', sans-serif;
			background-color: rgba(255,255,255,0);
			padding: 0.2vw 0.5vw;
			margin-top: 1vw;
			color: white;
			font-size: 0.75em;
			border-bottom-width: 0.2vh;
			margin-bottom: 5vh;
		}

		#addbook input:focus {
			outline: none;
			border-bottom: 0.6vw solid  white;
			animation: underline;
			animation-duration: 0.3s;
			border-bottom-width: 0.3vh;
		}

		#addbook button {
			position: absolute;
			top: 75vh;
			left: 46vw;
			height: 7vh;
			min-width: 8vw;
			background: #ff3300;
			border: none;
			outline: none;
			border-radius: 0.3vw;
			display: block;
			color: black;
			border-width: 0;
			font-weight: bold;
			font-family: 'Roboto', sans-serif;
			font-size: 0.3em;
			cursor: pointer;
		}

		#bookname {
			position: absolute;
			top: 15vh;
			left: 20vw;
		}

		#booktext {
			position: absolute;
			top: 26vh;
			left: 20vw;
		}

		#author {
			position: absolute;
			top: 44vh;
			left: 20vw;
		}

		#authortext {
			position: absolute;
			top: 54vh;
			left: 20vw;
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

		#addb {
			max-height: 5vh;
			position: absolute;
			top: 1vh;
			right: 1vh;
			cursor: pointer;
		}

		#sort {
			position: absolute;
			bottom: 1vh;
			right: 1vh;
			height: 5vh;
			width: 5vw;
			font-family: 'Roboto', sans-serif;
			background-color: black;
			color: #ff3300;
			font-family: 1.5em;
			border: 0;
			border-radius: 1vh;
		}

		#sort:focus {
			outline: none;
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
		<span>Welcome <?php echo $_SESSION['name']; ?>!</span><br><br>LIST OF BOOKS

		<img src="add.png" id="addb" onclick="document.getElementById('addbook').style.display='block'; document.getElementsByTagName('body')[0].style.overflow = 'hidden'" onmouseenter="$(this).attr('src','addhover.png')" onmouseleave="$(this).attr('src','add.png')">

		<select id="sort" name="sort">
			<?php

				if($sort == "ID DESC") {
					echo "<option value='R' selected>Recent</option>";
					echo "<option value='A'>A to Z</option>";
					echo "<option value='Z'>Z to A</option>";
				}

				else if($sort == "NAME ASC") {
					echo "<option value='R'>Recent</option>";
					echo "<option value='A' selected>A to Z</option>";
					echo "<option value='Z'>Z to A</option>";
				}

				else if($sort == "NAME DESC") {
					echo "<option value='R'>Recent</option>";
					echo "<option value='A'>A to Z</option>";
					echo "<option value='Z' selected>Z to A</option>";
				}

			?>
		</select>

	</div>

	<?php

	$query = $conn->prepare("SELECT ID, NAME, AUTHOR, ISSUED FROM BOOKS ORDER BY ".$sort);
	$query->execute();
		
	if($query->rowCount()==0) {
		echo "<div id=\"nobooks\" style='background-color: rgba(0,0,0,0.7);width: 75%; font-size: 7em; color: white; position:absolute; text-align: center; border-radius: 2vh; top: 53vh; left: 12.5vw;'>No Books Found</div>";
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

	<div id="addbook">

		<img src="close.png" id="closeimg" onclick="document.getElementById('addbook').style.display='none'">

		<label id="bookname"><i>Name of the Book</i></label>
		<input type="text" id="booktext" name="bookname" required="true">
		<label id="author"><i>Author</i></label>
		<input type="text" id="authortext" name="author" required="true">
		<button id="addbookbutton" type="button">ADD BOOK</button>

	</div>

	<div id="popup" style="display: none"><span>Book added successfully</span><img src="closepop.png" onclick="popuprem()"></div>

	<div id="nobooks" style='background-color: rgba(0,0,0,0.7);width: 75%; font-size: 7em; color: white; position:absolute; text-align: center; border-radius: 2vh; top: 53vh; left: 12.5vw;display: none'>No Books Found</div>

	<script type="text/javascript">

		function popuprem() {
			$('#popup').slideUp(700);
			$("#welcometext").animate({top: "-=7vh"}, 700);
			$("#booktable").animate({top: "-=7vh"}, 700);
			$("#nobooks").animate({top: "53vh"}, 700);
			document.getElementById('popup').style.display = "none";
		}

		function popupdisp() {
			if(document.getElementById('popup').style.display == "block") return false;
			else return true;
		}

		function update(bid, msg) {

			if(msg == "addsuccess") {

				document.getElementById('popup').innerHTML = "<span>Book added successfully</span><img src=\"closepop.png\" onclick=\"popuprem()\">"
				document.getElementById('addbook').style.display = 'none';
				document.getElementsByTagName("body")[0].style.overflowY = "auto";
				
				var arr = bid.split(";");

				var id = arr[0];
				var name = arr[1];
				var author = arr[2];

				var removeimg = "<img src=\"remove.png\" onmouseenter = \"$(this).attr('src','removehover.png')\" onmouseleave = \"$(this).attr('src','remove.png')\"  style=\"max-height: 4vh; position: relative; top: 1.5vh; cursor: pointer;\" onclick=\"removebook('"+id+"','N')\">";

				var row = "<tr id=\"book"+id+"\"><td style = 'padding: 2vh 2vw 0.5vh 2vw'><b>"+name+"</b> <span style = 'font-size: 0.77em'><i>by</i> &nbsp<b>"+author+"</b> </span> </td><td style = 'text-align: right; padding-right: 2vw'>"+removeimg+"</td></tr>";

				$('#booktable tr:first').animate({ paddingTop: '2vh' }, 0);
				document.getElementById('nobooks').style.display = "none";
				document.getElementById('booktable').style.backgroundColor = "rgba(0,0,0,0.7)";
				$(row).insertBefore('#booktable tr:first').fadeIn(1000, function() { 
					$('#popup').slideDown(700);
					if(popupdisp()) {
						$("#welcometext").animate({top: "+=7vh"}, 700);
						$("#booktable").animate({top: "+=7vh"}, 700);
						document.getElementById('popup').style.display = "block";
					}
				});

			}
			else if(msg == "remsuccess") {
				
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
						$("#nobooks").animate({top: "60vh"}, 700);
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
			else if(msg == "adderror") {
				document.getElementsByTagName("body")[0].style.overflowY = "auto";
				document.getElementById('addbook').style.display = 'none';
				document.getElementById('popup').innerHTML = "<span>Book already exists</span><img src=\"closepop.png\" onclick=\"popuprem()\">"
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

		$('#addbookbutton').click(function() {
			var bookn = document.getElementById("booktext").value;
			var author = document.getElementById("authortext").value;

			var arg = "bookname="+bookn+"&author="+author;
			
			if (window.XMLHttpRequest) {
    			xmlhttp = new XMLHttpRequest();
 			}
			else {
	       		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("booktext").value = "";
					document.getElementById("authortext").value = "";
					update(this.responseText, this.responseText.slice(-10));
				}
			}

			xmlhttp.open("POST", "addbook.php", true);
			xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlhttp.send(arg);
		});

		$('#sort').on('change', function() {
  			
  			if (window.XMLHttpRequest) {
	    		xmlhttp = new XMLHttpRequest();
	 		}
			else {
		    	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
					
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					window.location.replace("index.php");
				}
			}

			xmlhttp.open("POST", "sort.php", true);
			xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlhttp.send("val="+this.value);

  		});

  		$('#searchbutton').mouseenter(function() {
  			$(this).attr('src','searchhover.png');
  		});
  		$('#searchbutton').mouseleave(function() {
  			$(this).attr('src','search.png');
  		});

  		$('#closeimg').mouseenter(function() {
  			$(this).attr('src','closehover.png');
  		});
  		$('#closeimg').mouseleave(function() {
  			$(this).attr('src','close.png');
  		});



	</script>

</body>

</html>