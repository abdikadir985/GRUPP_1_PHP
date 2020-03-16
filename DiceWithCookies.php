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
		include("include/OneDice.php");
		include("include/SixDices.php");
		$dice = new OneDice(6);
		$dice->setNbr(1);
		$dice->getNbr();
		$sixDices = new SixDices();
		$sixDices->rollDices();

		//Var uppmärksam på att PHP-tolken används på ett flertal ställen i filen!
		$disabled = true;

		if(isset( $_POST["btnNewGame"])) {
			//uppgift 1a.
			echo("New Game!");
			//uppbift 1b.
			setcookie("nbrOfRounds",0, time() + 3600);
			setcookie("sumOfAllRounds",0, time() + 3600);

			$disabled = false;
		}
		//uppgift 1c,4,5
		if( isset( $_POST["btnExit"])) {
			setcookie( "nbrOfRounds", "", time() - 3600);
			setcookie( "sumOfAllRounds", "", time() - 3600);
		}
		//uppgift 1c och 3
		if(isset( $_POST["btnRoll"])){
			echo("Button Rolled");

			$nbr = $_COOKIE["nbrOfRounds"];
			$sum = $_COOKIE["sumOfAllRounds"];
			$sum = $sum + $sixDices->sumDices();
			$nbr++;
			setcookie("nbrOfRounds", $nbr, time() + 3600);
			setcookie("sumOfAllRounds", $sum, time() + 3600);
			echo($sixDices->svgDices());
			echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
			echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
			echo("<p>" ."average value is:". $sum/6 . "</p>" . PHP_EOL);

			$disabled = false;
		}
		//uppgift 2.
		if(!isset($_POST["btnRoll"]) &&
		!isset($_POST["btnExit"]) &&
		!isset($_POST["btnNewGame"]) &&
		isset($_COOKIE["nbrOfRounds"]) &&
		isset($_COOKIE["sumOfAllRounds"])) {
			$nbr = $_COOKIE["nbrOfRounds"];
			$sum = $_COOKIE["sumOfAllRounds"];
			$sum = $sum + $sixDices->sumDices();
			$nbr++;
			setcookie("nbrOfRounds", $nbr, time() + 3600);
			setcookie("sumOfAllRounds", $sum, time() + 3600);
			echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
			echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
			echo("<p>" ."average value is:". $sum/6 . "</p>" . PHP_EOL);
			
			$disabled = false;
		}

		?>
	</div>


	<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
		<!--uppgift 5-->
		<input type="submit" name="btnRoll" class="btn btn-primary" value="Roll six dices" <?php if($disabled) { echo("disabled"); }?>/>
		<input type="submit" name="btnNewGame" class="btn btn-primary" value="New Game" />
		<input type="submit" name="btnExit" class="btn btn-primary" value="Exit" <?php if($disabled) { echo("disabled"); }?>/>
	</form>

	<?php

	echo( "<pre>" );
	print_r( $_POST );
	print_r( $_COOKIE );
	echo( "</pre>" );

	?>

	<script src="script/animation.js"></script>
</body>

</html>
