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
            $result = $this->IDC->prepare('INSERT INTO commentaire(`idu`, `idjv`, `libelle`, `note`) VALUES  (:idu, :idjv, :libellecom, :note)');
            $result->execute(Array(
                "idu" => $idu,
                "idjv" => $idjv,
                "libellecom" => $libelleCom,
                "note" => $note
            ));
        }
        return $result; // si nb =1 alors l'insertion s est bien passee
    }

    public function getCommentaireS() {
        // recupere TOUS LES commentaires de la BDD
        if ($this->IDC) {
            $result = $this->IDC->query ('SELECT * from commentaire WHERE validation=0');
            return $result;
        }
    }

    public function getCommentairesIdjv($idJV) {
        // recupere TOUS LES commentaires  POUR UN JEU
        if ($this->IDC) {    
            $result = $this->IDC->prepare('SELECT * from commentaire where idjv = :idjv and validation=1');
            $result->execute(Array(
                "idjv" => $idJV
            ));
        }
        return $result;
    }
    public function update($idu,$idjv,$validation) {
        //modification d'un commentaire l'aide de ces 2 identifiants
        if ($this->IDC) {
            $result = $this->IDC->prepare('UPDATE commentaire SET validation= :validation WHERE idu = :idu and idjv = :idjv');
            $result->execute(Array(
                "validation" => $validation,
                "idu" => $idu,
                "idjv" => $idjv
            ));
        }
    }	
}