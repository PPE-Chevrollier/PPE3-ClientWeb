<?php
require_once ('../modele/userModele.class.php');

$msgERREUR = "";

if (isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['ListeCom'])) {
    
    $modeleUser = new userModele ();
    
    $idUser = -1;
    $resultId = $modeleUser->getID($_POST['email']);

    foreach ($resultId as $Id) $idUser = $Id->IDUSER;
    
    if ($idUser == -1){
        $modeleUser->add($_POST['email'], $_POST['pseudo'], $_POST['ListeCom']);
        $msgERREUR = "SUCCESS : Ajout de cet utilisateur !";
    }
    else $msgERREUR = "ERREUR : vous êtes déjà inscrit !";
}

header ('Location: ../vue/inscriptionUser.php?error=' . $msgERREUR);