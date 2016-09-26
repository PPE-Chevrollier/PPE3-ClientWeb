<?php
session_start();

require_once ('../class/pageBase.class.php');
require_once ('../class/pageSecurisee.class.php');
require_once ('../modele/jeuxVideosModele.class.php');

if (isset($_SESSION['idU']) && isset($_SESSION['mdpU'])) {
    $pageConsultationJetC = new pageSecurisee("Consulter les commentaires sur les jeux...");
} else {
    $pageConsultationJetC = new pageBase("Consulter les commentaires sur les jeux...");
}
$pageConsultationJetC->style = 'template'; //pour g�rer le style de mon tableau
$pageConsultationJetC->script ='jquery-3.0.0.min';
$pageConsultationJetC->script = 'ajaxRecupCommentairesParJeux'; //pour g�rer par l'AJAX le clic de la case � cocher et afficher les commentaires correspondants


$JVMod = new JeuxVideosModele();
$listeJV = $JVMod->getJeuxVideoS(); //requ�te via le modele

$pageConsultationJetC->contenu = '<section>
					<table>
					<tr><th>Nom du jeu</th><th>ann&eacute;e de sortie</th><th>&eacute;diteur</th></tr>';
//parcours du r�sultat de la requete
foreach ($listeJV as $unJV){
					$pageConsultationJetC->contenu .= '<tr><td>'.$unJV->NOMJV.'</td><td>'.$unJV->ANNEESORTIE.'</td><td>'.$unJV->EDITEUR.'</td>
					<td><input type="radio" onclick="jsClickRadioButton();" name="nomidjv"  id="'. $unJV->IDJV.'"  value="'. $unJV->IDJV.'" /></td></tr>';
}
$listeJV->closeCursor (); // pour lib�rer la m�moire occup�e par le r�sultat de la requ�te
$listeJV = null; // pour une autre ex�cution avec cette variable

$pageConsultationJetC->contenu .= '</table>';

//div qui sert � afficher les commentaires propore � un jeu : rempli � partir du json retourn� par la requ�te AJAX
$pageConsultationJetC->contenu .= '<div id="listeCom"></div></section>';


$pageConsultationJetC->afficher();