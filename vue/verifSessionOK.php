<?php
session_start ();
include ('../class/autoload.php');


$page= new pageBase ( "NotaGAME - Se Connecter" );
?>	<script type="text/javascript">	cacher();</script>	<?php

/* cas ou la session existe deja, donc il a clique sur se Deconnecter */
if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	/* Dans ce cas, on d�truit la session SUR LE SERVEUR */
	$_SESSION = array (); /* on vide le contenu de session sur le serveur */
	// Dans ce cas, on d�truit aussi l'identifiant de SESSION en recr�ant le cookie de SESSION avec une dateHeure p�rim�e (time() -42000)
	if (ini_get ( "session.use_cookies" )) {
		$params = session_get_cookie_params ();
		setcookie ( session_name (), '', time () - 42000, $params ["path"], $params ["domain"], $params ["secure"] );
	}
	// on d�truit la session sur le serveur
	session_destroy ();

	// on le redirige vers la page index
	header ('Location:verifSessionOK.php?error=SUCCES : Vous venez d\'être déconnecté !');
} else {
	// traitement du formulaire (si on vient du formulaire alors
	if ((isset ( $_POST ['idU'] )) && (isset ( $_POST ['mdpU'] ))) {

		// Session active : on va verifier si les identifiants de connexion sont valides (ici login et motDepasse en dur dans le programme)
		// mais on pourrait récupérer le login et mot de passe de la BDD
		if (($_POST ['idU'] == 'adminNG') && ($_POST ['mdpU'] == 'QSDFG')) {
				
			$_SESSION ['idU'] = $_POST ['idU'];
			$_SESSION ['mdpU'] = $_POST ['mdpU'];
				
			// on appelle la nouvelle classe Page_s�curis�e car les utilisateurs sont habilit�s � VOIR cette page(avec le menu specifique)
			$page = new pageSecurisee ( "SIO : session ouverte" );
			$page->contenu = "La session est valide, vous allez acceder à vos pages securisées<br/>";
			$page->contenu .= "<br/>Vous vous etes connectes avec l'identifiant : " . $_SESSION ['idU'] . "<br/><br/><br/><br/><br/><br/><br/>";
				
		} else {
			// les identifiants de connexion existe mais ne sont pas VALABLES
			// on le redirige vers la page index
				header ('Location:verifSessionOK.php?error=ERREUR : Login ou mot de passe non valide !');
		}
	}
	 else { // pas de session donc on affiche le formulaire de connexion (on vient donc de la page base avec Se Connecter)

		$page->contenu = "<br/>Veuillez vous connecter !!!! <br/>";

		// action # car on reste sur la meme page
		$page->contenu .= '<form action="#" method="POST" >
							<fieldset>
							<legend>Se Connecter</legend>
								<input type="text" name="idU" id="idU"size="15" maxlength="15" placeholder="Identifiant" autofocus required >
								<input type="password" name="mdpU" id="mdpU" size="15" maxlength="15" placeholder="Mot de passe" required>
								<input type="submit" value="Valider">
								<input type="reset" value="Recommencer">
							</fieldset>
						</form>';
	}
}

// TRAITEMENT du RETOUR DE L'ERREUR 
if (isset($_GET['error']) && !empty($_GET['error'])) {  
	?>	<script type="text/javascript">	montrer();</script>	<?php
	$page->contenu .= '<div id="infoERREUR"><h1>Informations !</h1><div id="dialog1" >'. $_GET['error'].'</div>';
	$verif = preg_match("/ERREUR/",$_GET['error']);
		if ( $verif == TRUE ){
		$page->contenu .= '<a class="no" onclick="cacher();">OK</a></div>';
		}else {
		$page->contenu .= '<a class="yes" onclick="cacher();">OK</a></div>';
		}
}
		
$page->afficher();		