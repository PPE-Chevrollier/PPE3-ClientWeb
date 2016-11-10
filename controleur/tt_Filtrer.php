<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/jeuxVideosModele.class.php');

$monModele = new jeuxVideosModele();
/*
if ($_GET['idGenres'] == -1){
    $Jeux = $monModele->getJeuxVideoS();
}
else{*/
    $idGenres = -1;

    if ($_GET['idGenres'] != -1) $idGenres = explode(",", $_GET['idGenres']);
    
    $Jeux = $monModele->getJeuxVideoTrie($idGenres, $_GET['colone'], $_GET['sens'], $_GET['annee'], $_GET['editeur']);
//}


$tabJV = array();

foreach ($Jeux as $unJeux)
{
    $tabJV[] = array(
        "IDJV" => $unJeux->IDJV,
        "NOMJV" => $unJeux->NOMJV,
        "ANNEESORTIE" => $unJeux->ANNEESORTIE,
        "EDITEUR" => $unJeux->EDITEUR,
        "GENRE" => $unJeux->GENRE,
        "NOTE" => $unJeux->NOTE);
}

// envoi du resultat formate en json
echo json_encode($tabJV);