<?php
	afficherEntete();
		

		//aiguillage
		
		
		if (isset($_REQUEST['choix'])){
			switch ($_REQUEST ['choix']) {
				case 'inscription':

				     afficherFormulaireInscrption();
					// code...
					break;
				default:
					break;
				}
			}
		else{
			afficherAccueil();
		}
		afficherBas();

	
	function afficherFormulaireInscrption(){
	echo "<form method='post'>
	<input type='text'placeholder='pseudo' name='pseudo'><br>
	<input type='mail'placeholder='mail' name='mail'><br>
	<input type='text'placeholder='bonjour merci aurevoir' name='chaineMots'><br>
	<input type='submit'value='enregistre' name='choix'></form>";
}
	
	function afficherEntete(){
		echo "<!DOCTYPE html>
				<html>
					<head>
						<title>inscription</title>
						<meta charset='utf-8'>
					</head>
					<body>";
	}

	function afficherAccueil(){
		echo "<form method='post' action=''>
		<button type='submit'value='inscription' name='choix'>inscription</button>
		
		
		</form>";
		

	}
	function afficherBas(){
		echo "</body>
			</html>";
	}
?>