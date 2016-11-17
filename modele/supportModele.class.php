<?php
require_once '../class/connexion.class.php';

class supportModele {
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
    public function getSupports() {
        // recupere toutes les genres de la BDD
        if ($this->idCom) {
            $req = "";
            return $this->idCom->query('SELECT DISTINCT c.IDS, NOMS FROM support s RIGHT JOIN compatible c ON s.IDS = c.IDS ORDER BY NOMS');
        }
    }
}