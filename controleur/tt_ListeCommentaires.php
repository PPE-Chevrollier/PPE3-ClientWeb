<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/commentaireModele.class.php');
require_once ('../modele/userModele.class.php');

$json = array(); //tableau pour stocker les commentaires
$monModele = new commentaireModele();
$monModeleUser = new userModele();

if (isset($_POST['idJV'])){
    //requete presente dans le modele qui retourne les commentaires propres a un jeu.
    $liste = $monModele->getCommentairesIdjv($_POST['idJV']); 
}
else{
    //requete presente dans le modele qui renvoie TOUS LES COMMENTAIRES
    $liste = $monModele->getCommentaireS();
}

$json = array();

//parcours de tous les resultats contenus dans $liste
foreach ($liste as $unCom) {
    
    $tab = $monModeleUser->getUserPseudo($unCom->IDU);
    
    foreach ($tab as $tuple) $pseudo = $tuple->pseudo;
    
    $json[] = array(
        "IDU" => $unCom->IDU,
        "IDJV" => $unCom->IDJV,
        "LIBELLE" => $unCom->LIBELLE,
        "VALIDATION" => $unCom->VALIDATION,
        "NOTE" => $unCom->NOTE,
        "PSEUDO" => $pseudo);
}

echo json_encode($json);