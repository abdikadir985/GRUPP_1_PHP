
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
				include("include/OneDice.php");
				include("include/SixDices.php");
				function deleteSession() {
					session_unset();
					if( ini_get("session.use_cookies") ) {
						$sessionCookieData = session_get_cookie_params();
			
						$path = $sessionCookieData["path"];
						$domain = $sessionCookieData["domain"];
						$secure = $sessionCookieData["secure"];
						$httponly = $sessionCookieData["httponly"];
						$name = session_name();			
						setcookie($name, "", time() - 3600, $path, $domain, $secure, $httponly);			
					}
					session_destroy();
				}
				session_start(); 
				session_regenerate_id(true);
				$dice = new OneDice(6);
				$dice->setNbr(1);
				$dice->getNbr();
				$sixDices = new SixDices();
				$sixDices->rollDices();
				$disabled=false;

				if(isset($_GET["linkNewGame"])){
					echo "New Game!";
					$_SESSION["nbrOfRounds"]=0;
					$_SESSION["sumOfAllRounds"]=0;
					$disabled=false;
				}
				if(isset($_GET["linkExit"])){
					//session_destroy();
					deleteSession();
				}
				if(isset($_GET["linkRoll"])&&
				isset($_SESSION["nbrOfRounds"]) &&
				isset($_SESSION["sumOfAllRounds"])){
					$nbr =$_SESSION["nbrOfRounds"];
					$sum =$_SESSION["sumOfAllRounds"];
					$sum = $sum+$sixDices->sumDices();
					$nbr++;
					$_SESSION["nbrOfRounds"] = $nbr;
					$_SESSION["sumOfAllRounds"] = $sum;
					echo($sixDices->svgDices());
					echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
					echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
					echo("<p>" ."average value is:". $sum/$nbr . "</p>" . PHP_EOL);
		
					$disabled = false;
				}
				if(!isset($_GET["linkRoll"]) &&
				!isset($_GET["linkExit"]) &&
				!isset($_GET["linkNewGame"]) &&
				isset($_SESSION["nbrOfRounds"]) &&
				isset($_SESSION["sumOfAllRounds"])) {
					$nbr = $_SESSION["nbrOfRounds"];
					$sum = $_SESSION["sumOfAllRounds"];
					echo("<p>" ."total dices are:". $nbr . "</p>" . PHP_EOL);
					echo("<p>" ."Sum of dices:". $sum . "</p>" . PHP_EOL);
					echo("<p>" ."average value is:". $sum/$nbr . "</p>" . PHP_EOL);
		
					$disabled = false;
				}
			?>
		</div>
		
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkRoll=true" class="btn btn-primary<?php if( $disabled ) { echo("disabled"); } ?>">Roll six dices</a>
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkNewGame=true" class="btn btn-primary">New game</a>
		<a href="<?php echo $_SERVER["PHP_SELF"]; ?>?linkExit=true" class="btn btn-primary<?php if( $disabled ) { echo("disabled"); } ?>">Exit</a>
		
		<script src="script/animation.js"></script>
		
	</body>

</html>
