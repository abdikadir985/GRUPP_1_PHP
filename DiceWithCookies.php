<!doctype html>
<html lang="en" >

<head>
	<meta charset="utf-8" />
	<title>Roll the dice...</title>
	<link href="style/style.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

	<div>
		<?php
		//denna är konstruktionen för att kunna inkludera onedice och sixdices...
		//där vi därifrån skapar en ny onedice med siffran 6 inom för att få
		//systemet att förstå att det finns 6 tärningar att beräkna... (via setnbr och getnbr)
		//vi hade också skapat en ny sixdices. ($sixDices->rollDices(); handlar om animationen)
		include("include/OneDice.php");
		include("include/SixDices.php");
		$dice = new OneDice(6);
		$sixDices = new SixDices();
		$sixDices->rollDices();

		//här är den avstängd
		$disabled = true;
	  //vid tryck av btnNewGame:
		if(isset( $_POST["btnNewGame"])) {
			//uppgift 1a. - skriv ut detta när du trycker på btnNewGame
			echo("New Game!");
			//uppbift 1b. - här skapar vi två cookies med siffrorna '0' var och finns tillgänglig i en timme
			setcookie("nbrOfRounds",0, time() + 3600);
			setcookie("sumOfAllRounds",0, time() + 3600);
			//den är aktiv här...
			$disabled = false;
		}
		//uppgift 1c,4,5 - här tar den bort de skapade cookies när du trycker på btnExit
		if( isset( $_POST["btnExit"])) {
			setcookie( "nbrOfRounds", "", time() - 3600);
			setcookie( "sumOfAllRounds", "", time() - 3600);
		}
		//uppgift 1c och 3 - när du trycker på btnRoll och cookieserna nbrOfRounds
		//och sumOfAllRounds finns skapade:
		if(isset( $_POST["btnRoll"]) &&
		isset($_COOKIE["nbrOfRounds"]) &&
		isset($_COOKIE["sumOfAllRounds"])){
			//skriv ut button rolled på sidan
			echo("Button Rolled");
			//här gör vi några placeringar av cookies,
			//och bygger upp hur $sum ska se ut... (samt där nbr ökar)
			$nbr = $_COOKIE["nbrOfRounds"];
			$sum = $_COOKIE["sumOfAllRounds"];
			$sum = $sum + $sixDices->sumDices();
			$nbr++;
			//här i cookieserna har vi stoppat in strukturen för nbr och sum...
			setcookie("nbrOfRounds", $nbr, time() + 3600);
			setcookie("sumOfAllRounds", $sum, time() + 3600);
			//animationen visas
			echo($sixDices->svgDices());
			//utskriften av antalet, summan och medelvärdet.
			echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
			echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
			echo("<p>" ."average value is:". $sum/$nbr . "</p>" . PHP_EOL);
			//den är aktiv...
			$disabled = false;
		}
		//uppgift 2. - om du inte har tryck på någon av knapparna tillgängliga
		//och cookieserna är skapade...
		if(!isset($_POST["btnRoll"]) &&
		!isset($_POST["btnExit"]) &&
		!isset($_POST["btnNewGame"]) &&
		isset($_COOKIE["nbrOfRounds"]) &&
		isset($_COOKIE["sumOfAllRounds"])) {
			//(föränkling för användning inom echo...)
			$nbr = $_COOKIE["nbrOfRounds"];
			$sum = $_COOKIE["sumOfAllRounds"];
			//så skriver vi ut det antal, summa, medelvärde som sattes tidigare...
			echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
			echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
			if($nbr == 0){
				echo("<p>" ."average value is:". 0 . "</p>" . PHP_EOL);
			}
			else{
				echo("<p>" ."average value is:". $sum/$nbr . "</p>" . PHP_EOL);
			}
			//aktiv...
			$disabled = false;
		}

		?>
	</div>


	<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
		<!--uppgift 5 - if-satserna finns för att, är $disabled = true är dessa knappar inte tillgängliga...-->
		<input type="submit" name="btnRoll" class="btn btn-primary" value="Roll six dices" <?php if($disabled) { echo("disabled"); }?>/>
		<input type="submit" name="btnNewGame" class="btn btn-primary" value="New Game" />
		<input type="submit" name="btnExit" class="btn btn-primary" value="Exit" <?php if($disabled) { echo("disabled"); }?>/>
	</form>

	<?php
	/*
	echo( "<pre>" );
	print_r( $_POST );
	print_r( $_COOKIE );
	echo( "</pre>" );
	*/
	?>

	<script src="script/animation.js"></script>
</body>

</html>
