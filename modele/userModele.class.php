<?php
require_once ('../class/connexion.class.php');
class userModele {
	/*
	 * propriete d'un contact conforme � la BDD : PAS besoin ici private $nom; private $prenom; private $mail; private $nomSociete; private $villeSociete; private $fonction;
	 */
	
	// identifiant de connexion utile dans toute la classe
	private $IDC;
	public function __construct() {
		// creation de la connexion afin d'executer les requêtees
		try {
			$ConnexionContact = new Connexion ();
			$this->IDC = $ConnexionContact->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($email,$pseudo,$communaute) {
		// ajoute ce contact dans la BDD
		$nb = 0;
		if ($this->IDC) {
			$req = "INSERT INTO users(`email`, `pseudo`, `idco`) VALUES  ('" . $email . "','" . $pseudo . "','" . $communaute . "');";
			$nb = $this->IDC->exec ( $req );
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	public function getID($email) {
		// recuperel'IDU de l'utilisateur grace � son email unique
		if ($this->IDC) {
			$result = $this->IDC->query ( "SELECT idu from users where email='" . $email . "';" );
			return $result;
                        
                        
		}
	}
	
	public function getUser($email,$pseudo){
		//permet de savoir si un utilisateur existe avec cet email et ce pseudo
		//renvoie le nmbre d'utilisateur 1 s'il existe ou 0 sinon
		if ($this->IDC) {
			$result = $this->IDC->query ( "SELECT * from users where email='" . $email . "' and pseudo='". $pseudo. "';" );
			return $result;
                        
                        //$result = $this->IDC->prepare('SELECT * from users where email=? and pseudo=?;');
                        
		}
		
		
	}
	public function getUserS() {
		// recupere TOUS LES utilisateurs de la BDD
		if ($this->IDC) {
			$result = $this->IDC->query ( "SELECT * from users ORDER BY email;" );
			return $result;
		}
	}
        
        public function getUserPseudo($id)
        {
            if ($this->IDC){
                return $this->IDC->query("SELECT pseudo from users where idu=". $id .";");
            }
        }
}