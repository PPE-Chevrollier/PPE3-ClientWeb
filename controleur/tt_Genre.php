<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/genreModele.class.php');

$monModele = new genreModele();
$Genres = $monModele->getGenres();

$tabG = array();

foreach ($Genres as $unGenre)
{
    $tabG[] = array(
        "IDGENRE" => $unGenre->IDGENRE,
        "LIBELLE" => $unGenre->LIBELLE);
}

// envoi du resultat formate en json
echo json_encode($tabG);