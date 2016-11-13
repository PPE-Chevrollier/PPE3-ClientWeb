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
            $req = "SELECT DISTINCT c.IDGENRE, LIBELLE FROM genre s RIGHT JOIN correspondre c ON s.IDGENRE = c.IDGENRE ORDER BY LIBELLE";
            return $this->idCom->query($req);
        }
    }
}