<?php
header('Content-Type: text/html;charset=UTF-8');

require_once ('../modele/jeuxVideosModele.class.php');

$monModele = new jeuxVideosModele();

function toTab($champ){
    $tab = -1; //Valeur par default si pas de trie

    if ($champ != -1) $tab = explode(",", $champ); //Recupération des id de genres dans un talbeau
    
    return $tab;
}

$Jeux = $monModele->getJeuxVideoTrie(toTab($_POST['idGenres']), toTab($_POST['idSupports']), $_POST['colone'], $_POST['sens'], $_POST['annee'], $_POST['editeur']);

$tabJV = array();

foreach ($Jeux as $unJeux)
{
    $tabJV[] = array(
        "IDJV" => $unJeux->IDJV,
        "NOMJV" => $unJeux->NOMJV,
        "ANNEESORTIE" => $unJeux->ANNEESORTIE,
        "EDITEUR" => $unJeux->EDITEUR,
        "GENRE" => $unJeux->GENRE,
        "SUPPORT" => $unJeux->SUPPORT,
        "NOTE" => $unJeux->NOTE);
}

// envoi du resultat formate en json
echo json_encode($tabJV);