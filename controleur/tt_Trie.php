<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/genreModele.class.php');
require_once ('../modele/jeuxVideosModele.class.php');

$genreModele = new genreModele();
$jeuxvideoModele = new jeuxVideosModele();

$Genres = $genreModele->getGenres();
$Annee = $jeuxvideoModele->getAnnee();
$Editeur = $jeuxvideoModele->getEditeur();

$json = array();

$json[0] = array(); //genre
$json[1] = array(); //aneee
$json[2] = array(); //editeur
        
foreach ($Genres as $unGenre)
{
    $json[0][] = array(
        "IDGENRE" => $unGenre->IDGENRE,
        "LIBELLE" => $unGenre->LIBELLE);
}

foreach ($Annee as $uneAnnee)
{
    $json[1][] = array(
        "ANNEESORTIE" => $uneAnnee->ANNEESORTIE);
}

foreach ($Editeur as $unEditeur)
{
    $json[2][] = array(
        "EDITEUR" => $unEditeur->EDITEUR);
}

// envoi du resultat formate en json
echo json_encode($json);