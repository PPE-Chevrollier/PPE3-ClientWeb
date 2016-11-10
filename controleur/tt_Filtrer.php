<?php
header('Content-Type: text/html;charset=UTF-8');

require_once ('../modele/jeuxVideosModele.class.php');

$monModele = new jeuxVideosModele();

$idGenres = -1; //Valeur par default si pas de trie

if ($_POST['idGenres'] != -1) $idGenres = explode(",", $_POST['idGenres']); //Recupération des id de genres dans un talbeau

$Jeux = $monModele->getJeuxVideoTrie($idGenres, $_POST['colone'], $_POST['sens'], $_POST['annee'], $_POST['editeur']);

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