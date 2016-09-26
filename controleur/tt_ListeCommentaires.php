<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/commentaireModele.class.php');
require_once ('../modele/userModele.class.php');

$json = array(); //tableau pour stocker les commentaires
$monModele = new commentaireModele();
$monModeleUser = new userModele();

if (isset($_GET['idJV'])){
	//requete presente dans le modele qui retourne les commentaires propres a un jeu.
	$liste = $monModele->getCommentairesIdjv($_GET['idJV']); 
}
else{
	//requete presente dans le modele qui renvoie TOUS LES COMMENTAIRES
	$liste = $monModele->getCommentaireS();
}

//parcours de tous les resultats contenus dans $liste
foreach ($liste as $unCom) {
// je remplis un tableau JSON avec juste le libelle du commentaire
    $index= $unCom->IDJV."-".$unCom->IDU; //pour ne pas avoir de doublons
    
    $tab = $monModeleUser->getUserPseudo($unCom->IDU);
    
    foreach ($tab as $tuple) $pseudo = $tuple->pseudo;
    
    $valeur = $unCom->LIBELLE . " - " . $pseudo;

    $json[$index] = ($valeur);

}
			
$liste->closeCursor(); // pour liberer la memoire occupee par le resultat de la requete
$liste = null; // pour une autre execution avec cette variable

// envoi du resultat formate en json
echo json_encode($json);