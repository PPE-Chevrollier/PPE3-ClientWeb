<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/genreModele.class.php');
require_once ('../modele/jeuxVideosModele.class.php');
require_once ('../modele/supportModele.class.php');

$genreModele = new genreModele();
$jeuxvideoModele = new jeuxVideosModele();
$supportModele = new supportModele();

$Genres = $genreModele->getGenres();
$Annee = $jeuxvideoModele->getAnnee();
$Editeur = $jeuxvideoModele->getEditeur();
$Support = $supportModele->getSupports();

$json = array();

$json[0] = array(); //aneee
$json[1] = array(); //editeur
$json[2] = array(); //genre
$json[3] = array(); //support
        

foreach ($Annee as $uneAnnee)
{
    $json[0][] = array(
        "ANNEESORTIE" => $uneAnnee->ANNEESORTIE);
}

foreach ($Editeur as $unEditeur)
{
    $json[1][] = array(
        "EDITEUR" => $unEditeur->EDITEUR);
}

foreach ($Genres as $unGenre)
{
    $json[2][] = array(
        "IDGENRE" => $unGenre->IDGENRE,
        "LIBELLE" => $unGenre->LIBELLE);
}

foreach ($Support as $unSupport)
{
    $json[3][] = array(
        "IDS" => $unSupport->IDS,
        "NOMS" => $unSupport->NOMS);
}

// envoi du resultat formate en json
echo json_encode($json);