<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/jeuxVideosModele.class.php');

$monModele = new jeuxVideosModele();

$idGenres = explode(",", $_GET['idGenres']);

$tabJeux = $monModele->getJeuxVideoSGenres($idGenres);


	





$liste->closeCursor(); // pour liberer la memoire occupee par le resultat de la requete
$liste = null; // pour une autre execution avec cette variable

// envoi du resultat formate en json
echo json_encode($json);