<?php
	class Membre{

		protected $_id;
		protected $_pseudo;
		protected $_mail;
		protected $_chaineMots;

		public function __construct($id,$pseudo=null,$mail=null,$chaineMots=null){
			$this->_id=$id;
			if($id==null){
				$this->_pseudo=$pseudo;
				$this->_mail=$mail;
				$this->_chaineMots=$chaineMots;
			}else
				$this->load();
		}
		public function setId($id){
			$this->_id=$id;
		}
		public function getId(){
			return $this->_id;
		}
		public function setPseudo($pseudo){
			$this->_pseudo=$pseudo;
		}
		public function getPseudo(){
			return $this->_pseudo;
		}
		public function setMail($mail){
			$this->_mail=$mail;
		}
		public function getMail(){
			return $this->_mail;
		}
		public function setChaineMots($chaineMots){
			$this->_chaineMots=$chaineMots;
		}
		public function getChaineMots(){
			return $this->_chaineMots;
		}
		public function save(){
			include("connectionDB.php");
			$sql = "INSERT INTO Membres(pseudo ,mail, chaineMots) VALUES(?, ?, ?);";
			$stmt = $bdd->prepare($sql);   // préparation de la requète
			$stmt->bindParam(1, $this->_pseudo);
			$stmt->bindParam(2, $this->_mail);
			$stmt->bindParam(3, $this->_chaineMots);
			if ($stmt->execute()==true)
				$this->id = $bdd->lastInsertId(); // recup id auto-incrementé généré par la base
			else 
				die ('erreur requete '.$sql);
		}
		protected function load(){
			include("connectionDB.php");
			$sql="select * from Membres where Id=?;";
			$stmt=$bdd->prepare($sql);
			
			$stmt->bindParam(1,$this->_id);
			if ($stmt->execute()==true){
				$result=$stmt->fetch();
				$this->setPseudo($result['pseudo']);
				$this->setMail($result['mail']);
				$this->setChaineMots($result['chaineMots']);
			}
			//echo $result['pseudo']." ".$result['mail']." ".$result['chaineMots'];
		}
		public function delete(){
			include("connectionDB.php");
			$sql="delete from Membres where Id=?;";
			$stmt=$bdd->prepare($sql);

			$stmt->bindParam(1,$this->_id);
			$stmt->execute();
		}
		public function update(){
			include("connectionDB.php");
			$sql="update Membres set pseudo=?,mail=?,chaineMots=? where Id=?";
			$stmt=$bdd->prepare($sql);
			$stmt->bindParam(1,$this->_pseudo);
			$stmt->bindParam(2,$this->_mail);
			$stmt->bindParam(3,$this->_chaineMots);
			$stmt->bindParam(4,$this->_id);
			$stmt->execute();
		}
		public static function getListe(){
			include("connectionDB.php");
			$sql="select id from Membres;";
			$liste=array();
			$stmt=$bdd->query($sql);
			while($result=$stmt->fetch()){
				$liste[]=new Membre($result['id']);
			}
			return $liste;
		}
		public function motCommun(){
			include("connectionDB.php");
			$sql="select * from Membres where id=?;";
			$stmt=$bdd->prepare($sql);
			$stmt->bindParam(1,$_REQUEST['id']);
			$stmt->execute();
			$tutu=$stmt->fetch();
			$liste=explode(" ",$tutu['chaineMots']);
			$sql1="select * from Membres;";
			$stmt1=$bdd->prepare($sql1);
			$stmt1->execute();
			$bool=false;
			$tabPseudo=array();
			$tabmots=array();
			$tab=array();
			$str='';
			while($resul=$stmt1->fetch()){
				$listeautre=explode(" ",$resul['chaineMots']);
				$actuel='';
				if($actuel!=$resul['pseudo']){
					$str='';
					$actuel=$resul['pseudo'];
				}
				for($i=0;$i<sizeof($liste);$i++){
				
					if(in_array($liste[$i],$listeautre) AND $tutu['pseudo']!=$resul['pseudo'] ){
						$str=$str.strval($listeautre[array_search($liste[$i],$listeautre)])." ";
						$tab[$resul['pseudo']]=$str;
					}
				}	
									
			}
							
							return $tab;
							
		}



	}
?>