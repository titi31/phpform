<link rel='stylesheet' href='style.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">News</a>
  <a href="http://localhost/contact.php">Contact</a>
  <a href="#about">About</a>
  <a href='#home'>logout</a>
  <a href="http://www.perdu.com">error</a>
</div> 
<br>
		<?php

		afficherEntete();
		if (isset($_REQUEST['choix']))
		{
			switch ($_REQUEST ['choix']) 
			{
				case 'inscription':

				     afficherFormulaireInscrption();
				     break;
				case 'enregistre':
				     include('Membre.php');
				     $membre= new Membre(null,$_REQUEST['pseudo'],$_REQUEST['mail'],$_REQUEST['chaineMots']);
				     $membre->save();
				     echo 'je vais traiter le formulaire';
				     break;
				case 'connecter':
				     include('Membre.php');
				     $membre=new Membre($_REQUEST['id']);
				     
				     if($membre->getPseudo()==null)
				     {
					afficherAccueil();
				        echo "user n'existe pas reessayer";
				     }
				     else
				     {
					echo "<div id='monCompte'>".$membre->getPseudo()."<br> ".
					      $membre->getMail()."<br> ".$membre->getChaineMots()."
					      <form method='post'><input type='hidden' value='".$_REQUEST['id']
					      ."' name='id'><button type='submit' value='deluser' name='choix'>
					      delete user</button><br><button type='submit' value='upuser' name='choix'>
					      mettre a jour user</button></div>
					      <button type='submit' value='mots' name='choix'>chercher mot commun</button>
					      </form>";
				     }
				     break;	
				case 'mots':
					include("Membre.php");
					$membre=new Membre($_REQUEST['id']);
				        $mots=$membre->motCommun();
								
					foreach($mots as $cle => $valeur)
					{
					 	echo $cle." a comme mot commun : ".$valeur."<br>";
					}
					
					if($mots==null)
						echo "pas de mots commun";
						break;
					
				case 'deluser':
					include('Membre.php');
					$membre=new Membre($_REQUEST['id']);
					$membre->delete();
					echo  $membre->getPseudo()." a été supprimer";
					break;
				case 'upuser':
					include('Membre.php');
					$membre=new Membre($_REQUEST['id']);
					modifier($membre);
					break;
				case "updateb":	
					include('Membre.php');
					$membre=new Membre($_REQUEST['up']);
					$membre->setPseudo($_REQUEST['pseudoupdate']);
					$membre->setMail($_REQUEST['mailupdate']);
					$membre->setChaineMots($_REQUEST['listeupdate']);
					$membre->update();	
					echo "bien modifié";
					break;
				case "pseudo":
					include("Membre.php");
					afficherAccueil();
					echo  "<div id='liste'>";
					$liste=Membre::getListe();
					
					foreach($liste as $membre )
					{
						echo $membre->getPseudo()." ".$membre->getMail()."<br>";
					}
					echo "</div>";
					break;
				case 'cacher':
					afficherAccueil();
					echo "<style type='text/css'>#liste{display:none;}</style>";
					break;
				default:
					break;
			}
	
		}
		else
		{
			afficherAccueil();
		}

		afficherBas();

	function afficherFormulaireInscrption()
	{
		echo "<form method='post'>
		<input type='text'placeholder='pseudo' name='pseudo'><br>
		<input type='mail'placeholder='mail' name='mail'><br>
		<input type='text'placeholder='bonjour merci aurevoir' name='chaineMots'><br>
		<input type='submit'value='enregistre' name='choix'></form>";
	}

	function modifier($membre)
	{
		echo "<form method='post'>
		     <input type='text' value='".$membre->getPseudo()."' name='pseudoupdate'>
		     <input type='text' value='".$membre->getMail()."' name='mailupdate'>
		     <input type='text' value='".$membre->getChaineMots()."' name='listeupdate'>
		     <input type='hidden' value='".$_REQUEST['id']."' name='up'>
		     <button type='submit' value='updateb' name='choix'>mettre a jour</button>
		     </form>";
	}
	
	function afficherEntete()
	{
		echo "<!DOCTYPE html>
		      <html>
			<head>
				<title>inscription</title>
				<meta charset='utf-8'>
				<link rel='stylesheet' href='style.css'>
			</head>
			<body>";
	}

	function afficherAccueil()
	{
		echo "<form method='post' action='' id='home'>
		<div id='boutonInscrire'><button type='submit'value='inscription' name='choix'>inscription</button>
		</div><br>
		<input type='text' placeholder='tape le numero de id' name='id'>
		<button type='submit' value='connecter' name='choix'>se Connecter</button><br>
		<button type='submit' value='pseudo' name='choix'>afficher user</button>
		<button type='submit' value='cacher' name='choix'>cacher user</button>
		</form>";
		

	}
	function afficherBas()
	{
		echo "</body>
			</html>";
	}
?>
