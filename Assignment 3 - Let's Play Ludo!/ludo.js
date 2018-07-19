var tokenLockerA = 2, tokenLockerB = 2, tokenAout = 0, tokenBout = 0, boardA = "A1", boardB = "B1", pos = {A1: -1, A2: -1, B1: -1, B2: -1}, fin = true;
	diceval = Number(Math.floor(Math.random()*6+1)), playerTurn = "A", releaseA = "A1", releaseB = "B1", err = false, moveA1max = 6, moveA2max = 6,
	 moveB1max = 6, moveB2max = 6;

var lockerADisplay = document.getElementById("a").getElementsByTagName("h1")[0], lockerBDisplay = document.getElementById("b").getElementsByTagName("h1")[0],
	playerTurnDisplay = document.getElementsByTagName("LI")[0], diceDisplay = document.getElementById("rolled").getElementsByTagName("img")[0],
	diceInput = document.getElementById("dice"), resultDisplay = document.getElementById("result");

var a1 = document.getElementById("tokenA1"), a2 = document.getElementById("tokenA2"), b1 = document.getElementById("tokenB1"),
	b2 = document.getElementById("tokenB2");

function load(event) {

	if(event.which == 13) rolldice();

}

function other(token) {

	if(token == "A1") return "A2";

	else if(token == "A2") return "A1";

	else if(token == "B1") return "B2";

	else if(token == "B2") return "B1";

}

function opp(player) {

	if(player == "A")return "B";

	else return "A";

}

function finish() {

	playerTurnDisplay.innerHTML = "TURN of Player " + playerTurn;

	a1.style.pointerEvents="none";

	a2.style.pointerEvents="none";

	b1.style.pointerEvents="none";

	b2.style.pointerEvents="none";

	a1.style.cursor="defaut";

	a2.style.cursor="defaut";

	b1.style.cursor="defaut";

	b2.style.cursor="defaut";

	document.getElementById("tip1").style.display="none";

	document.getElementById("tip2").style.display="none";

	document.getElementById("roll").style.pointerEvents="auto";

	fin = false;

	if(pos["A1"] >= 22 && pos["A1"] <= 27) moveA1max = 27 - pos["A1"];

	if(pos["A2"] >= 22 && pos["A2"] <= 27) moveA2max = 27 - pos["A2"];

	if(pos["B1"] >= 8 && pos["B1"] <= 13) moveB1max = 13 - pos["B1"];

	if(pos["B2"] >= 8 && pos["B2"] <= 13) moveB2max = 13 - pos["B2"];

	if(pos["A1"] == 27) {
		tokenAout += 1;
		boardA = "A2";
		pos["A1"] = 28;
		$("#tokenA1").fadeOut(500);
		$("#tokenA1").animate({ top: '27vh', left: '-22vh'}, 0);
		$("#tokenA1").fadeIn(500);
	}

	if(pos["A2"] == 27) {
		tokenAout += 1;
		boardA = "A1";
		pos["A2"] = 29;
		$("#tokenA2").fadeOut(500);
		$("#tokenA2").animate({ top: '27vh', left: '-32vh'}, 0);
		$("#tokenA2").fadeIn(500);
	}

	if(pos["B1"] == 13) {
		tokenBout += 1;
		boardB = "B2";
		pos["B1"] = 30;
		$("#tokenB1").fadeOut(500);
		$("#tokenB1").animate({ top: '51vh', left: '99.75vh'}, 0);
		$("#tokenB1").fadeIn(500);
	}

	if(pos["B2"] == 13) {
		tokenBout += 1;
		boardB = "B1";
		pos["B2"] = 31;
		$("#tokenB2").fadeOut(500);
		$("#tokenB2").animate({ top: '51vh', left: '109.75vh'}, 0);
		$("#tokenB2").fadeIn(500);
	}

	if(tokenAout == 2) {
		document.getElementById("result").innerHTML = "Player <br /><span>A</span><br /> Won!";
		document.getElementById("result").getElementsByTagName("span")[0].style.color = "#cc0000";
		$("#result").fadeIn(1000);
		$("#resbg").fadeIn(800);
		$("#playagain").fadeIn(1000);
	}

	else if(tokenBout == 2) {
		document.getElementById("result").innerHTML = "Player <br /><span>B</span><br /> Won!";
		document.getElementById("result").getElementsByTagName("span")[0].style.color = "#0000cc";
		$("#result").fadeIn(1000);
		$("#resbg").fadeIn(800);
		$("#playagain").fadeIn(1000);
	}
	
}

function cut(token) {

	switch(token) {

		case "bothA": {

			tokenLockerA += 2;

			pos["A1"] = -1;

			pos["A2"] = -1;

			boardA = "A1";

			releaseA = "A2";

			$("#tokenA1").animate({ top: '11vh', left: '-22vh'}, 1000, function() { finish(); });

			$("#tokenA2").delay(400).animate({ top: '11vh', left: '-32vh'}, 1000, function() { finish(); });

		} break;

		case "bothB": {

			tokenLockerB += 2;

			pos["B1"] = -1;

			pos["B2"] = -1;

			boardB = "B1";

			releaseB = "B2";

			$("#tokenB1").animate({ top: '72vh', left: '109.5vh'}, 1000);

			$("#tokenB2").delay(400).animate({ top: '72vh', left: '99.5vh'}, 1000, function() { finish(); });

		} break;

		case "A1": {

			tokenLockerA += 1;

			pos["A1"] = -1;

			boardA = "A2";

			releaseA = "A1";

			if(tokenLockerA == 2) {

				boardA = "A1";

				$("#tokenA1").animate({ top: '11vh', left: '-22vh'}, 1000);

				$("#tokenA2").animate({ left: '-32vh'}, 1000, function() { finish(); });

			}

			else {

				$("#tokenA1").animate({ top: '11vh', left: '-22vh'}, 1000, function() { finish(); });

			}

		} break;

		case "A2": {

			tokenLockerA += 1;

			pos["A2"] = -1;

			boardA = "A1";

			releaseA = "A2";

			$("#tokenA2").animate({ top: '11vh', left: '-22vh'}, 1000, function() { finish(); });

		} break;

		case "B1": {

			tokenLockerB += 1;

			pos["B1"] = -1;

			boardB = "B2";

			releaseB = "B1";

			if(tokenLockerB == 2) {

				boardB = "B1";

				$("#tokenB1").animate({ top: '72vh', left: '99.75vh'}, 1000);

				$("#tokenB2").animate({ left: '109.75vh'}, 1000, function() { finish(); });

			}

			else {

				$("#tokenB1").animate({ top: '72vh', left: '99.75vh'}, 1000, function() { finish(); });

			}

		} break;

		case "B2": {

			tokenLockerB += 1;

			pos["B2"] = -1;

			boardB = "B1";

			releaseB = "B2";

			$("#tokenB2").animate({ top: '72vh', left: '99.75vh'}, 1000, function() { finish(); });

		}
	}
}

function doublecheck(player, token) {

	if(pos[token] == pos[other(token)]) {

		switch(player) {

			case "A": {

				a1.src = './Images/2A.png';

				a2.src = './Images/A2.png';

			} break;

			case "B": {

				b1.src = './Images/2B.png';

				b2.src = './Images/B2.png';

			}

		}

	}

	switch(player) {

			case "A": {

				if(pos[token] == pos["B1"] && pos[token] != pos["B2"]) cut("B1");

				else if(pos[token] == pos["B2"] && pos[token] != pos["B1"]) cut("B2");

				else if(pos[token] == pos["B1"] && pos[token] == pos["B2"]) cut("bothB");

			} break;

			case "B": {

				if(pos[token] == pos["A1"] && pos[token] != pos["A2"]) cut("A1");

				else if(pos[token] == pos["A2"] && pos[token] != pos["A1"]) cut("A2");

				else if(pos[token] == pos["A1"] && pos[token] == pos["A2"]) cut("bothA");

			}

		}

	if(fin) finish();

}

function releaseToken(player, token) {

	switch(player) {

		case "A" : {

			tokenLockerA -= 1;

			if(token == "A1") releaseA = "A2";

			else releaseA = "A1";
			
			if(pos[boardA] == 0) {

				$("#token"+token).animate({top: '-=7.75vh', left: '+=25.25vh'}, 1000, function() { pos[token] = 0; a1.src = './Images/2A.png'; a2.src = './Images/A2.png'; finish(); });

			}

			else if(pos["B1"] == 0 && pos["B2"] != 0) { pos[token] = 0; cut("B1"); }

			else if(pos["B2"] == 0 && pos["B1"] != 0) { pos[token] = 0; cut("B2"); }

			else if(pos["B1"] == 0 && pos["B2"] == 0) { pos[token] = 0; b1.src = './Images/B.png'; cut("bothB"); }

			else {

				$("#token"+token).animate({opacity: '0'}, 500);

				$("#token"+token).animate({top: '-=7.75vh', left: '+=25.25vh'}, 0);

				$("#token"+token).animate({opacity: '1'}, 500, function() { finish(); });

				pos[token] = 0;

				if(tokenLockerA == 1)$("#token"+ releaseA).animate({left: '+=10vh'}, 1000, function() { if(fin) finish(); });

			}
			
		} break;

		case "B" : {

			tokenLockerB -= 1;

			if(token == "B1") releaseB = "B2";

			else releaseB = "B1";
			
			if(pos[boardB] == 14) {

				$("#token"+token).animate({top: '+=2.75vh', left: '-=25.25vh'}, 1000, function() { pos[token] = 14; b1.src = './Images/2B.png'; b2.src = './Images/B2.png'; finish(); });

			}

			else if(pos["A1"] == 14 && pos["A2"] != 14) { pos[token] = 14; cut("A1"); }

			else if(pos["A2"] == 14 && pos["A1"] != 14) { pos[token] = 14; cut("A2"); }

			else if(pos["A1"] == 14 && pos["A2"] == 14) { pos[token] = 14; a1.src = './Images/A.png'; cut("bothA"); }

			else {

				$("#token"+token).animate({opacity: '0'}, 500);

				$("#token"+token).animate({top: '+=2.75vh', left: '-=25.25vh'}, 0);

				$("#token"+token).animate({opacity: '1'}, 500, function() { finish(); });

				pos[token] = 14;

				if(tokenLockerB ==  1) $("#token"+ releaseB).animate({left: '-=10vh'}, 1000, function() {if(fin) finish(); });

			}
			
		}

	}

}

function moveToken(token) {

	if(pos[token] == -1) releaseToken(token.slice(0,1), token);

	else {

		var player = token.slice(0,1);

		var oldpos = Number(pos[token]), newpos = Number(pos[token]) + Number(diceval);

		if(oldpos >= 0 && oldpos <= 6) {

			if(newpos <= 7) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval > 4) time = 250 * diceval;

				else if(diceval == 1) time1 = 500;

				$("#token" + token).animate({left: '+='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token);});

			}

			else {

				var moveby1 = (7-oldpos)*10.2 + 'vh', moveby2 = (newpos - 7)*10.2 + 'vh';

				var time1 = 400 * (7-oldpos), time2 = 400 * (newpos-7);

				if(7-oldpos > 4) time1 = 250 * diceval; else if(diceval == 1) time1 = 500;

				if(newpos-7 > 4) time2 = 250 * diceval; else if(diceval == 1) time2 = 500;

				$("#token" + token).animate({left: '+='+moveby1}, time1);

				$("#token" + token).animate({top: '+='+moveby2}, time2, function() { pos[token] = newpos; doublecheck(player,token); });

			}

		}

		else if(oldpos >= 7 && oldpos <= 13 && player == "A") {

			if(newpos <= 14) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval > 4) time = 250 * diceval;

				else if(diceval == 1) time = 500;

				$("#token" + token).animate({top: '+='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token); });

			}

			else {

				var moveby1 = (14-oldpos)*10.2 + 'vh', moveby2 = (newpos - 14)*10.2 + 'vh';

				var time1 = 400 * (14-oldpos), time2 = 400 * (newpos-14);

				if(14-oldpos > 4) time1 = 250 * diceval; else if(diceval == 1) time1 = 500;

				if(newpos-14 > 4) time2 = 250 * diceval; else if(diceval == 1) time2 = 500;

				$("#token" + token).animate({top: '+='+moveby1}, time1);

				$("#token" + token).animate({left: '-='+moveby2}, time2, function() { pos[token] = newpos; doublecheck(player,token); });

			}

		}

		else if(oldpos >= 7 && oldpos <= 13 && player == "B") {

			if(newpos <= 13) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval >= 4) time = 250 * diceval

				else if(diceval == 1) time = 500;

				$("#token" + token).animate({top: '+='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token); });

			}

			else {

				document.getElementById("win").style.display="block";

				newpos = oldpos;

				finish();

			}

		}

		else if(oldpos >= 14 && oldpos <= 20) {

			if(newpos <= 21) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval > 4) time = 250 * diceval;

				else if(diceval == 1) time = 500;

				$("#token" + token).animate({left: '-='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token); });

			}

			else {

				var moveby1 = (21-oldpos)*10.2 + 'vh', moveby2 = (newpos - 21)*10.2 + 'vh';

				var time1 = 400 * (21-oldpos), time2 = 400 * (newpos-21);

				if(21-oldpos > 4) time1 = 250 * diceval; else if(diceval == 1) time1 = 500;

				if(newpos-21 > 4) time2 = 250 * diceval; else if(diceval == 1) time2 = 500;

				$("#token" + token).animate({left: '-='+moveby1}, time1);

				$("#token" + token).animate({top: '-='+moveby2}, time2, function() { pos[token] = newpos; doublecheck(player,token); });

			}

		}

		else if(oldpos >= 21 && oldpos <= 27 && player == "B") {

			if(newpos <= 28) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval >= 4) time = 250 * diceval;

				else if(diceval == 1) time = 500;

				if(newpos > 27) newpos -= 28;

				$("#token" + token).animate({top: '-='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token); });

			}

			else {

				var moveby1 = (28-oldpos)*10.2 + 'vh', moveby2 = (newpos - 28)*10.2 + 'vh';

				var time1 = 400 * (28-oldpos), time2 = 400 * (newpos-28);

				if(28-oldpos > 4) time1 = 250 * diceval; else if(diceval == 1) time1 = 500;

				if(newpos-28 >= 4) time2 = 250 * diceval; else if(diceval == 1) time2 = 500;

				if(newpos > 27) newpos -= 28;

				$("#token" + token).animate({top: '-='+moveby1}, time1);

				$("#token" + token).animate({left: '+='+moveby2}, time2, function() { pos[token] = newpos; doublecheck(player,token); });

			}

		}

		else if(oldpos >= 21 && oldpos <= 27 && player == "A") {

			if(newpos <= 27) {

				var moveby = diceval*10.2 + 'vh';

				var time = 400 * diceval;

				if(diceval >= 4) time = 250 * diceval;

				else if(diceval == 1) time = 500;

				$("#token" + token).animate({top: '-='+moveby}, time, function() { pos[token] = newpos; doublecheck(player,token); });

			}

			else {

				if(newpos > 27) newpos -= 28;

				newpos = oldpos;

				document.getElementById("win").style.display="block";

				finish();

			}

		}
		
	}

	
}

function rolldice() {

	document.getElementById("roll").style.pointerEvents="none";

	document.getElementById("win").style.display="none";

	fin = true;

	if(diceInput.value == "") {

		diceval = Math.floor(Math.random()*6+1);

	}

	else {

		diceval = Number(diceInput.value);

	}

	if(diceval>6 || diceval < 1) { alert("Enter a number between 1 and 6"); finish(); }

	else {

	switch(diceval) {

		case 1: diceDisplay.src="./Images/1.jpg"; break;

		case 2: diceDisplay.src="./Images/2.jpg"; break;

		case 3: diceDisplay.src="./Images/3.jpg"; break;

		case 4: diceDisplay.src="./Images/4.jpg"; break;

		case 5: diceDisplay.src="./Images/5.jpg"; break;

		case 6: diceDisplay.src="./Images/6.jpg"; break;

	}

	switch(playerTurn) {

		case "A" : { 

					if(tokenLockerA ==2) {

						if(diceval == 6) {

							playerTurn = "A";

							releaseToken("A", releaseA);
							
						}

						else {

							playerTurn = "B";

							finish();
						}
					}

					else if(tokenLockerA == 1 && tokenAout == 0 && pos["A1"] == -1 && moveA2max < diceval) {

						if(diceval == 6) {

							playerTurn = "A";

							releaseToken("A", "A1");

						}

						else {

							playerTurn = "B";

							finish();
							
						}
					}

					else if(tokenLockerA == 1 && tokenAout == 0 && pos["A2"] == -1 && moveA1max < diceval) {

						if(diceval == 6) {

							playerTurn = "A";

							releaseToken("A", "A2");

						}

						else {

							playerTurn = "B";

							finish();
							
						}
					}

					else if(tokenLockerA == 1 && tokenAout == 0 && (moveA1max >= diceval || moveA2max >= diceval)) {

						if(diceval == 6) {

							playerTurn = "A";

							document.getElementById("token"+boardA).style.pointerEvents="auto";

							document.getElementById("token"+boardA).style.cursor="pointer";

							document.getElementById("token"+releaseA).style.pointerEvents="auto";

							document.getElementById("token"+releaseA).style.cursor="pointer";

							document.getElementById("tip1").style.display="block";

						}

						else {

							playerTurn = "B";

							moveToken(boardA);
							
						}
					}

					else if(tokenLockerA == 0 && tokenAout == 0 && moveA1max >= diceval && moveA2max >= diceval) {

						if(diceval == 6) {

							playerTurn = "A";

						}

						else playerTurn = "B";

						document.getElementById("tip1").style.display="block";

						if(pos["A1"] == pos["A2"]) {

							document.getElementById("tip1").style.display="none";

							a1.src = './Images/A.png';

							a2.src = './Images/A.png';

							moveToken("A1");

						}

						else {

							document.getElementById("tokenA1").style.pointerEvents="auto";

							document.getElementById("tokenA1").style.cursor="pointer";

							document.getElementById("tokenA2").style.pointerEvents="auto";

							document.getElementById("tokenA2").style.cursor="pointer";

						}

					}

					else if(tokenLockerA == 0 && tokenAout == 0 && moveA1max >= diceval && moveA2max < diceval) {

						if(diceval == 6) {

							playerTurn = "A";

						}

						else playerTurn = "B";

						moveToken("A1");

					}

					else if(tokenLockerA == 0 && tokenAout == 0 && moveA1max < diceval && moveA2max >= diceval) {

						if(diceval == 6) {

							playerTurn = "A";

						}

						else playerTurn = "B";

						moveToken("A2");

					}

					else if(tokenLockerA == 0 && tokenAout == 0 && moveA1max < diceval && moveA2max < diceval) {

						playerTurn = "B";

						finish();

					}
					
					else if(tokenLockerA == 0 && tokenAout == 1) {

						if(diceval == 6) {

							playerTurn = "A";

						}
						
						else {

							playerTurn = "B";

						}

						moveToken(boardA);
							
					}

					else if(tokenLockerA == 1 && tokenAout == 1) {

						if(diceval == 6) {

							playerTurn = "A";

							releaseToken("A", boardA);
						}

						else {

							playerTurn = "B";

							finish();
						}
					}

		} break;

		case "B" : { 

					if(tokenLockerB ==2) {

						if(diceval == 6) {

							playerTurn = "B";

							releaseToken("B", releaseB);
							
						}

						else {

							playerTurn = "A";

							finish();
						}
					}

					else if(tokenLockerB == 1 && tokenBout == 0 && pos["B1"] == -1 && moveB2max < diceval) {

						if(diceval == 6) {

							playerTurn = "B";

							releaseToken("B", "B1");

						}

						else {

							playerTurn = "A";

							finish();
							
						}
					}

					else if(tokenLockerB == 1 && tokenBout == 0 && pos["B2"] == -1 && moveB1max < diceval) {

						if(diceval == 6) {

							playerTurn = "B";

							releaseToken("B", "B2");

						}

						else {

							playerTurn = "A";

							finish();
							
						}
					}

					else if(tokenLockerB == 1 && tokenBout == 0 && (moveB1max >= diceval || moveB2max >= diceval)) {

						if(diceval == 6) {

							playerTurn = "B";

							document.getElementById("token"+boardB).style.pointerEvents="auto";

							document.getElementById("token"+boardB).style.cursor="pointer";

							document.getElementById("token"+releaseB).style.pointerEvents="auto";

							document.getElementById("token"+releaseB).style.cursor="pointer";

							document.getElementById("tip1").style.display="block";

						}

						else {

							playerTurn = "A";

							moveToken(boardB);
							
						}
					}

					else if(tokenLockerB == 0 && tokenBout == 0 && moveB1max >= diceval && moveB2max >= diceval) {

						if(diceval == 6) {

							playerTurn = "B";

						}

						else playerTurn = "A";

						document.getElementById("tip1").style.display="block";

						if(pos["B1"] == pos["B2"]) {

							document.getElementById("tip1").style.display="none";

							b1.src = './Images/B.png';

							b2.src = './Images/B.png';

							moveToken("B1");

						}

						else {

							document.getElementById("tokenB1").style.pointerEvents="auto";

							document.getElementById("tokenB1").style.cursor="pointer";

							document.getElementById("tokenB2").style.pointerEvents="auto";

							document.getElementById("tokenB2").style.cursor="pointer";

						}

					}

					else if(tokenLockerB == 0 && tokenBout == 0 && moveB1max >= diceval && moveB2max < diceval) {

						if(diceval == 6) {

							playerTurn = "B";

						}

						else playerTurn = "A";

						moveToken("B1");

					}

					else if(tokenLockerB == 0 && tokenBout == 0 && moveB1max < diceval && moveB2max >= diceval) {

						if(diceval == 6) {

							playerTurn = "B";

						}

						else playerTurn = "A";

						moveToken("B2");

					}

					else if(tokenLockerB == 0 && tokenBout == 0 && moveB1max < diceval && moveB2max < diceval) {

						playerTurn = "A";

						finish();

					}

					else if(tokenLockerB == 0 && tokenBout == 1) {

						if(diceval == 6) {

							playerTurn = "B";
							
						}

						else {

							playerTurn = "A";

						}

						moveToken(boardB);
							
					}

					else if(tokenLockerB == 1 && tokenBout == 1) {

						if(diceval == 6) {

							playerTurn = "B";

							releaseToken("B", boardB);
						}

						else {

							playerTurn = "A";

							finish();
						}
					}

				}
		}
	}

}

function playAgain() {

	document.getElementById("result").innerHTML = "Player <br /><span>A</span><br /> Won!";
	document.getElementById("result").getElementsByTagName("span")[0].style.color = "#cc0000";
	$("#result").fadeOut(800);
	$("#resbg").fadeOut(1000);
	$("#playagain").fadeOut(800);

	tokenLockerA = 2, tokenLockerB = 2, tokenAout = 0, tokenBout = 0, boardA = "A1", boardB = "B1", pos = {A1: -1, A2: -1, B1: -1, B2: -1}, fin = true;
	diceval = Number(Math.floor(Math.random()*6+1)), playerTurn = "A", releaseA = "A1", releaseB = "B1", err = false, moveA1max = 6, moveA2max = 6,
	moveB1max = 6, moveB2max = 6;

	$("#tokenA1").animate({ top: '11vh', left: '-22vh'}, 1000);
	$("#tokenA2").animate({ top: '11vh', left: '-32vh'}, 1000);
	$("#tokenB1").animate({ top: '72vh', left: '99.75vh'}, 1000);
	$("#tokenB2").animate({ top: '72vh', left: '109.75vh'}, 1000);
	diceDisplay.src = "";
	diceInput.value = "";
	playerTurnDisplay.innerHTML = "TURN of Player A";

}

function resetenter() {
	var text = document.getElementById("reset");
	var x = document.getElementById("resetimg2");
	x.style.cursor= 'pointer';
	x.style.transform= 'rotate(-360deg)';
	x.style.transitionDuration= '0.7s';
	x.style.transitionTimingFunction= 'easeInOut';
	text.style.right= "5vh";
	text.style.transition= "right 0.7s";
}

function resetleave() {
	var text = document.getElementById("reset");
	var x = document.getElementById("resetimg2");
	x.style.cursor= 'default';
	x.style.transform= 'rotate(+0deg)';
	x.style.transitionDuration= '0.7s';
	x.style.transitionTimingFunction= 'easeInOut';
	text.style.right= "-2vh";
	text.style.transition= "right 0.7s";
}
