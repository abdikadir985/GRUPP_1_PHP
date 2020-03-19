<?php session_start();?>
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
				//Var uppmärksam på att PHP-tolken används på ett flertal ställen i filen!
				//Var uppmärksam på att PHP-tolken används på ett flertal ställen i filen!
		include("include/OneDice.php");
		include("include/SixDices.php");


		$disabled = true;

		if(isset($_GET["linkNewGame"])){
    // 1 a
			echo("New Game!");
   // 1 b
  	setcookie("nbrOfRounds",0, time() + 3600);
	  setcookie("sumOfAllRounds",0, time() + 3600);

			$disabled = false;
		}
    // 1 c, 3
		if(isset( $_GET["btnRoll"]) &&
		isset($_SESSION["linkRoll"]) &&
		isset($_SESSION["linkExit"])){
		$nbr = $_SESSION["nbrOfRounds"];
		$sum = $_SESSION["sumOfAllRounds"];
		echo("Button Rolled");


    $disabled = false;
		}
    // 2
		if(!isset($_GET["linkExit"]) &&
		isset($_SESSION["nbrOfRounds"]) &&
		isset($_SESSION["sumOfAllRounds"])) {
		$nbr = $_SESSION["nbrOfRounds"];
		$sum = $_SESSION["sumOfAllRounds"];
		echo (...);
			?>
		</div>
		
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkRoll=true" class="btn btn-primary<?php if( $disabled ) { echo("disabled"); } ?>">Roll six dices</a>
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkNewGame=true" class="btn btn-primary">New game</a>
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkExit=true" class="btn btn-primary<?php if( $disabled ) { echo("disabled"); } ?>">Exit</a>
		
		<script src="script/animation.js"></script>
		
	</body>

</html>
