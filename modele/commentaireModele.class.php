<?php
require_once ('../class/connexion.class.php');
class commentaireModele {
	/*
	 * propriete d'un commentaire conforme � la BDD
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
	public function add($idu,$idjv, $libelleCom) {
		// ajoute ce contact dans la BDD
		$nb = 0;
		if ($this->IDC) {
			$req = "INSERT INTO commentaire(`idu`, `idjv`, `libelle`) VALUES  ('" . $idu . "','" . $idjv . "','" . $libelleCom . "');";
			$nb = $this->IDC->exec ( $req );
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	
	public function getCommentaireS() {
		// recupere TOUS LES commentaires de la BDD
		if ($this->IDC) {
			$result = $this->IDC->query ( "SELECT * from commentaire;" );
			return $result;
		}
	}
	
	public function getCommentairesIdjv($idJ) {
		// recupere TOUS LES commentaires  POUR UN JEU
		if ($this->IDC) {
			$result = $this->IDC->query ( "SELECT * from commentaire where idjv =".$idJ.";" );
			return $result;
		}
	}
	public function delete($idu,$idjv) {
		//supression d'un commentaire � l'aide de ces 2 identifiants
		if ($this->IDC) {
			$this->IDC->exec ( "DELETE FROM commentaire WHERE idu = ".$idu ." and idjv = ".$idjv.";");
		}
	}
	
}