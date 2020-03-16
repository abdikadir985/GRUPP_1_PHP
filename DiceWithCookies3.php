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
		$dice->setNbr(6);
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
			//uppgift 3
			echo( $sixDices->svgDices() );
			
			$disabled = false;
		}
		//uppgift 1c.
		if(isset( $_POST["btnExit"])){
			echo("Game Ended");
			$disabled = false;
		}

		if(isset( $_POST["btnRoll"])){
			echo("Button Rolled");
			echo( $sixDices->svgDices() );
            setcookie("nbrOfRounds",$_COOKIE["nbrOfRounds"]+1,time()+3600);
            setcookie("sumOfAllRounds",$_COOKIE["sumOfAllRounds"]+$sixDices->sumDices(),time()+3600);
			$disabled = false;
		}
		//uppgift 2.
		if(!isset($_POST["btnRoll"]) &&
		!isset($_POST["btnExit"]) &&
		!isset($_POST["btnNewGame"]) &&
		isset($_COOKIE["nbrOfRounds"]) &&
		isset($_COOKIE["sumOfAllRounds"])) {
			echo("<p>" ."Sum of dices:". $_COOKIE["sumOfAllRounds"]. "</p>" . PHP_EOL);
			echo("<p>" ."total dices are:". $_COOKIE["nbrOfRounds"] . "</p>" . PHP_EOL);
			if($_COOKIE["nbrOfRounds"]!=0){
				echo("<p>" ."average value is:".($_COOKIE["sumOfAllRounds"]/$_COOKIE["nbrOfRounds"]) . "</p>" . PHP_EOL);
			}else
				echo "<p> average value is :0";
			$disabled = false;
		}

		?>
	</div>

	<form action="<?php echo( $_SERVER["PHP_SELF"] ); ?>" method="post">
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