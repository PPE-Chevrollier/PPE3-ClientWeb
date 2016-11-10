<?php
session_start ();

require_once ('../class/pageBase.class.php');
require_once ('../class/pageSecurisee.class.php');
require_once ('../modele/jeuxVideosModele.class.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
    $pageIndex = new pageSecurisee ( "Ajouter des commentaires sur un jeu..." );
} else {
    $pageIndex = new pageBase ( "Ajouter des commentaires sur un jeu..." );
}

//on ajoute les styles et les scripts n�cessaires pour la validation de ce formulaire
$pageIndex->style = 'validationEngine.jquery';
$pageIndex->style = 'template';
$pageIndex->style = 'notationEtoile';
$pageIndex->script = 'jquery';
$pageIndex->script = 'jquery.validationEngine';
$pageIndex->script = 'notationEtoile';

$pageIndex->contenu = ' 
<section>
    <article>
        <form id="formNotationJV" class="formular" method="post" action="../controleur/tt_NotationJV.php">
            <div>
                <label for="date">Date : (format YYYY-MM-DD)</label>
                <input class="text-input" type="text" name="date"  id="date" value="'. date("Y-m-d"). '" disabled/>
            </div>
            <fieldset>
                <legend>Utilisateur</legend>
                <div>
                        <label for="email">Email : </label>
                        <input class="text-input" type="email" name="email" id="email" />
                </div>		
                <div>
                        <label for="pseudo">pseudo : </label>
                        <input class="text-input" type="text" name="pseudo" id="pseudo" />
                </div>
            </fieldset>
            <fieldset>
                <legend>Notation du jeu</legend>
                <div>
                    <label for="radioJV">Choisir un jeu vid&eacute;o : </label><br/>
                    <div>
                        <select name="radioJV" id="radioJV">';

$JVMod = new JeuxVideosModele();
$listeJV = $JVMod->getJeuxVideoS();

foreach ($listeJV as $unJV){
    $pageIndex->contenu .= '<option  id="' . $unJV->IDJV. '"  value="' . $unJV->IDJV. '" />' . $unJV->NOMJV . ' - ' . $unJV->ANNEESORTIE.'</option>';
}
				
			$pageIndex->contenu .= '
                        </select>
                    </div>
                </div>
                <div>
                    <label for="comments">Commentaire : </label>
                    <textarea class="text-input" name="comments" id="comments" rows="15" cols="10"></textarea>
                </div>
                <div>
                    <label for="notationEtoile">Choisissez une note : </label>
                    <ul class="notes-echelle" id="notationEtoile">
                        <li>
                                <label for="note01" title="Note&nbsp;: 1 sur 5">1</label>
                                <input type="radio" name="notesA" id="note01" value="1" />
                        </li>
                        <li>
                                <label for="note02" title="Note&nbsp;: 2 sur 5">2</label>
                                <input type="radio" name="notesA" id="note02" value="2" />
                        </li>
                        <li>
                                <label for="note03" title="Note&nbsp;: 3 sur 5">3</label>
                                <input type="radio" name="notesA" id="note03" value="3" />
                        </li>
                        <li>
                                <label for="note04" title="Note&nbsp;: 4 sur 5">4</label>
                                <input type="radio" name="notesA" id="note04" value="4" />
                        </li>
                        <li>
                                <label for="note05" title="Note&nbsp;: 5 sur 5">5</label>
                                <input type="radio" name="notesA" id="note05" value="5" />
                        </li>
                    </ul>
                </div>
            </fieldset>		
            <fieldset>
                <legend>Conditions</legend>
                <div class="infos">Je m\'engage &agrave; proposer des commentaires constructifs et non d&eacute;gradants</div>
                <div>
                    <span class="checkbox">J\'accepte les conditions : </span>
                    <input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree"/>
                </div>
            </fieldset>
            <p><input class="submit" type="submit" value="Valider" /></p>
            <hr/>
        </form>
    </article>		
</section>';
				
$listeJV->closeCursor (); // pour lib�rer la m�moire occup�e par le r�sultat de la requ�te
$listeJV = null; // pour une autre ex�cution avec cette variable
				
// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) { 
?>	<script type="text/javascript">	montrer();</script>	<?php 
	$pageIndex->contenu .= '<div id="infoERREUR"><h1>Informations !</h1><div id="dialog1" >'. $_GET['error'].'</div>';
		$verif = preg_match("/ERREUR/",$_GET['error']);
		if ( $verif == TRUE ){
		$pageIndex->contenu .= '<a class="no" onclick="cacher();">OK</a></div>';
		}else {
		$pageIndex->contenu .= '<a class="yes" onclick="cacher();">OK</a></div>';
		}
}
$pageIndex->afficher ();