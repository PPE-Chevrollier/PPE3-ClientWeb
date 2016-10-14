<?php
require_once '../class/connexion.class.php';

class genreModele {
    private $idCom = null;

    public function __construct() {
            // creation de la connexion afin d'executer les requetes
            try {
                $ConnexionJV = new Connexion();
                $this->idCom = $ConnexionJV->IDconnexion;
            } catch ( PDOException $e ) {
                    echo "<h1>probleme access BDD</h1>";
            }
    }
    public function getGenres() {
        // recupere toutes les genres de la BDD
        if ($this->idCom) {
            $req = "SELECT * from genre;";
            return $this->idCom->query($req);
        }
    }
}