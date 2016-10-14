<?php
session_start();

require_once ('../class/pageBase.class.php');
require_once ('../class/pageSecurisee.class.php');
require_once ('../modele/jeuxVideosModele.class.php');
require_once ('../modele/genreModele.class.php');

if (isset($_SESSION['idU']) && isset($_SESSION['mdpU'])) {
    $pageConsultationJetC = new pageSecurisee("Consulter les commentaires sur les jeux...");
} else {
    $pageConsultationJetC = new pageBase("Consulter les commentaires sur les jeux...");
}

$pageConsultationJetC->style = 'template'; //pour gï¿½rer le style de mon tableau
$pageConsultationJetC->style = 'filtreJeux';
$pageConsultationJetC->script ='jquery-3.0.0.min';
$pageConsultationJetC->script = 'ajaxRecupCommentairesParJeux'; //pour gï¿½rer par l'AJAX le clic de la case ï¿½ cocher et afficher les commentaires correspondants
$pageConsultationJetC->script = 'ajaxTrieParGenre';

$GMod = new genreModele();
$listeGenre = $GMod->getGenres();

$pageConsultationJetC->contenu = '<section>
                                        <div id="filtre">
                                            <form action="javascript:jsClickFiltrer()">
                                                <fieldset>
                                                    <h4>Filtre par genre :</h4>';
foreach ($listeGenre as $unG){
    $pageConsultationJetC->contenu .= '<input type="checkbox" value="'.$unG->IDGENRE . '"/>'.$unG->LIBELLE;
}
$pageConsultationJetC->contenu .= '                 <br/><br/><input type="submit" value="Filtrer" onclick="jsClickFiltrer();"/>
                                                </fieldset>                                                
                                            </form>                                            
                                        </div>
					<table id="tabJV"></table>
                                        <div id="listeCom"></div></section>';

$listeGenre->closeCursor (); // pour libï¿½rer la mï¿½moire occupï¿½e par le rï¿½sultat de la requï¿½te
$listeGenre = null; // pour une autre exï¿½cution avec cette variable

$pageConsultationJetC->afficher();