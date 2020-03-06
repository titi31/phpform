<?php
	echo
		"<!DOCTYPE html>
		  <html>
		  	<head><meta charset='utf-8'>
		  	<title>contact us</title>
		  	</head>
		  	<body>
		  		<form method='post'>
		  			<input type='mail' placeholder='ton email'><br>
		  			<input type='test' placeholder='object'><br>
					  <textarea>ecrire ton mail</textarea>
					  <button type='submit' value='envoie' name='choix' >Envoyer</button>
		  		</form>
		  	</body> 
		  </html>
		";

		  if(isset($_REQUEST['choix']))
		  {
			  switch($_REQUEST['choix'])
			  {
				  case 'envoie':
					echo "mail envoyé";  
					  break;
				  default:
					  break;
			  }
		  }
?>
