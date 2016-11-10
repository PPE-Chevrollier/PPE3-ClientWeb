<?php
require_once 'myPDO.class.php';

class Connexion {
	private $PARAM_hote = '192.168.152.2'; // le chemin vers le serveur local (pour les tests) ou serveur de production (sur la ferme)
	private $PARAM_utilisateur = 'notagame'; // nom d'utilisateur pour se connecter
	private $PARAM_mot_passe = 'Azerty123'; // mot de passe de l'utilisateur pour se connecter
	private $PARAM_nom_bd = 'bd_notagame'; // nom de ma base de donnees
	
	private $IDconnexion;
	
	public function __construct() {
            try {
                $this->IDconnexion = new myPDO ('mysql:host=' . $this->PARAM_hote . ';dbname=' . $this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe);
                $this->IDconnexion->exec('SET NAMES utf8');
            } 
            catch (PDOException $e) {
                    echo 'hote: ' . $this->PARAM_hote . ' ' . $_SERVER ['DOCUMENT_ROOT'] . '<br />';
                    echo 'Erreur : ' . $e->getMessage() . '<br />';
                    echo 'Num : ' . $e->getCode();
                    $this->IDconnexion = false;
                    echo '<script>alert ("ERREUR lien BDD");</script>';
            }
	}
	public function __get($propriete) {
            if ($propriete == 'IDconnexion') { return $this->IDconnexion;}
        }
}