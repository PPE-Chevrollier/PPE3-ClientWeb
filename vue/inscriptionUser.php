<?php
session_start ();

require_once ('../class/pageBase.class.php');
require_once ('../class/pageSecurisee.class.php');
require_once ('../modele/communauteModele.class.php');

?>	<script type="text/javascript">	cacher();</script>	<?php

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageInscriptionUser = new pageSecurisee ( "Inscription d'un utilisateur..." );
} else {
	$pageInscriptionUser = new pageBase ( "Inscription d'un utilisateur..." );
}


$pageInscriptionUser->contenu = '<section>
		<article>
			<form id="formInscriptionUser" method="post" action="../controleur/tt_InscriptionUser.php">
			<fieldset>
				<legend>Utilisateur</legend>
				<label>
					<span>Email : </span>
					<input type="text" name="email" id="email"  />
				</label>		
				<label>
					<span>pseudo : </span>
					<input  type="text" name="pseudo"  id="pseudo" />
				</label>
			<span>Choisir une communauté : </span><label><select name="ListeCom">';

                        $comMod = new communauteModele();
                        $listeCom = $comMod->getCommunautes();

                        foreach ($listeCom as $uneCom){
                            $pageInscriptionUser->contenu .= '<option  id="' . $uneCom->IDCO. '"  value="' . $uneCom->IDCO. '" />' . $uneCom->LIBELLE . '</option>';
                        }

                        $pageInscriptionUser->contenu .= '</select></label></div>
			</fieldset>
				<p><input class="submit" type="submit" value="Valider" /></p>
			</form>
		</article>		
	</section>';
                                               
        $listeCom->closeCursor(); // pour lib�rer la m�moire occup�e par le r�sultat de la requ�te
        $listeCom = null; // pour une autre ex�cution avec cette variable
						
//TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {  
	?>	<script type="text/javascript">	montrer();</script>	<?php
	$pageInscriptionUser->contenu .= '<div id="infoERREUR"><h1>Informations !</h1><div id="dialog1" >'. $_GET['error'].'</div>';
	$verif = preg_match("/ERREUR/",$_GET['error']);
		if ( $verif == TRUE ){
		$pageInscriptionUser->contenu .= '<a class="no" onclick="cacher();">OK</a></div>';
		}else {
		$pageInscriptionUser->contenu .= '<a class="yes" onclick="cacher();">OK</a></div>';
		}
}

$pageInscriptionUser->afficher();