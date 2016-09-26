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
$pageIndex->script = 'jquery';
$pageIndex->script = 'jquery.validationEngine-fr';
$pageIndex->script = 'jquery.validationEngine';

?> <script type="text/javascript">	cacher();</script> <?php

$pageIndex->contenu = '<section>
		<article>
			<form id="formNotationJV" class="formular" method="post" action="../controleur/tt_NotationJV.php">
			<label>
					<span>Date : (format YYYY-MM-DD)</span>
					<input class="validate[required,custom[date]] text-input" type="text" name="date"  id="date" value="'. date("Y-m-d"). '"/>
			</label>
			<fieldset>
				<legend>Utilisateur</legend>
				<label>
					<span>Email : </span>
					<input class="validate[required,custom[email]] text-input" type="text" name="email" id="email"  />
				</label>		
				<label>
					<span>pseudo : </span>
					<input class="validate[required] text-input" type="text" name="pseudo"  id="pseudo" />
				</label>
			</fieldset>
		<fieldset>
				<legend>Notation du jeu</legend>
				<div>
					<span>Choisir un jeu vid&eacute;o : </span><br/><label><select name="radioJV">';

$JVMod = new JeuxVideosModele();
$listeJV = $JVMod->getJeuxVideoS();

foreach ($listeJV as $unJV){
    $pageIndex->contenu .= '<option  id="' . $unJV->IDJV. '"  value="' . $unJV->IDJV. '" />' . $unJV->NOMJV . ' - ' . $unJV->ANNEESORTIE.'</option>';
}
				
			$pageIndex->contenu .= '</select></label></div>
			<label>
				<span>Commentaire : </span>
				<textarea class="validate[required,length[10,500]] text-input" name="comments" id="comments" rows="15" cols="10"> </textarea>
			</label>
			</fieldset>
		
			<fieldset>
				<legend>Conditions</legend>
				<div class="infos">Je m\'engage &agrave; proposer des commentaires constructifs et non d&eacute;gradants</div>
				<label>
					<span class="checkbox">J\'accepte les conditions : </span>
					<input class="validate[required] checkbox" type="checkbox"  id="agree"  name="agree"/>
				</label>
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