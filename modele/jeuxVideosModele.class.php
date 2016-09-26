<?php
require_once '../class/connexion.class.php';

class jeuxVideosModele {

	private $idcJV = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionJV = new Connexion();
			$this->idcJV = $ConnexionJV->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function add($nomjv,$anneesortie,$classification,$editeur,$description) {
		// ajoute ce jeux videos dans la BDD
		$nb = 0;
		if ($this->idcJV) {
			$req = "INSERT INTO jeuxvideos(`nomjv`, `anneesortie`, `classification`, `editeur`,`description`) VALUES  ('" . $nomjv . "','" . $anneesortie . "','" . $classification . "');";
			$nb = $this->idcJV->exec($req);
		}
		return $nb; // si nb =1 alors l'insertion s est bien passee
	}
	public function getID($nomjv,$anneesortie) {
		// recupere l'id du jeux videos correspondant �  au nom et � l'ann�e de sortie
		if ($this->idcJV) {
			$req= "SELECT idjv from jeuxvideos where nomjv=" . $nomjv . " and anneesortie=". $anneesortie . ";" ;
			$resultID = $this->idcJV->query($req);
			return $resultID;
		}
	}
	public function getJeuxVideoS() {
		// recupere TOUS LES jeux vid�os de la BDD
		if ($this->idcJV) {
			$req ="SELECT * from jeuxvideos ORDER BY nomjv, anneesortie;" ;
			$resultJV = $this->idcJV->query($req);
			return $resultJV;
		}
	}
}