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
    public function add($idu,$idjv, $libelleCom, $note) {
        // ajoute ce contact dans la BDD
        $nb = 0;
        if ($this->IDC) {
                $req = "INSERT INTO commentaire(`idu`, `idjv`, `libelle`, `note`) VALUES  ('" . $idu . "','" . $idjv . "','" . $libelleCom . "', '" . $note . "');";
                $nb = $this->IDC->exec ( $req );
        }
        return $nb; // si nb =1 alors l'insertion s est bien passee
    }

    public function getCommentaireS() {
        // recupere TOUS LES commentaires de la BDD
        if ($this->IDC) {
                $result = $this->IDC->query ( "SELECT * from commentaire WHERE validation=0;" );
                return $result;
        }
    }

    public function getCommentairesIdjv($idJ) {
        // recupere TOUS LES commentaires  POUR UN JEU
        if ($this->IDC) {
                $result = $this->IDC->query ( "SELECT * from commentaire where idjv =".$idJ." and validation=1;" );
                return $result;
        }
    }
    public function update($idu,$idjv,$validation) {
        //modification d'un commentaire l'aide de ces 2 identifiants
        if ($this->IDC) {
                $this->IDC->exec ( "UPDATE commentaire SET validation=".$validation ." WHERE idu = ".$idu ." and idjv = ".$idjv.";");
        }
    }	
}