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
$pageConsultationJetC->script = 'ajaxRecupGenre';

$pageConsultationJetC->contenu = '<section>
                                        <div id="filtre">
                                            <form action="javascript:jsClickFiltrer()">
                                                <fieldset>
                                                    <h4>Trie :</h4>
                                                    <div>
                                                        <label for="colone">Trier par : </label>
                                                        <select name="colone" id="colone">
                                                            <option value="NOMJV">Nom du jeux</option>
                                                            <option value="ANNEESORTIE">Année de sortie</option>
                                                            <option value="EDITEUR">Editeur</option>
                                                            <option value="NOTE">Note</option>
                                                        </select>
                                                        <input type="radio" name="sens" id="ASC" value="ASC" checked/><label for="ASC">Ascendant</label>
                                                        <input type="radio" name="sens" id="DESC" value="DESC"/><label for="DESC">Descendant</label>
                                                    </div>
                                                    <h4>Filtre par genre :</h4>
                                                    <div id="genres"></div>
                                                    <br/><br/><input type="submit" value="Valider" onclick="jsClickFiltrer();"/>
                                                </fieldset>                                                
                                            </form>                                            
                                        </div>
					<table id="tabJV"></table>
                                        <div id="listeCom"></div></section>';

$pageConsultationJetC->afficher();