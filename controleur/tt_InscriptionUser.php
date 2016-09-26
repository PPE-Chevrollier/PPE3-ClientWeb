<?php
//require_once ('../MODELE/CommentaireModele.class.php');
require_once ('../modele/userModele.class.php');
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
<?php

$msgERREUR = "";

if (isset($_POST ['email']) && isset($_POST ['pseudo']) && isset($_POST['communaute'])) {
	$modeleUser = new userModele ();
	try {
		// récupération de l(identifiant de l'utlisateur avec son email et son pseudo
		$resultU = $modeleUser->add($_POST['email'], $_POST['pseudo'], $_POST['communaute']);
		$msgERREUR = "SUCCESS : Ajout de cet utilisateur !";
	} catch (PDOException $pdoe) {
		// cas où 2 pseudo ont déjà mis un commentaire sur un jeu
		$msgERREUR = "ERREUR : vous êtes déjà inscrit ! : <br/>" . $pdoe->getMessage ();
	}
}

// redirection vers la page appelante en lui passant le message
header ('Location: ../vue/inscriptionUser.php?error=' . $msgERREUR);
exit();
?>
</html>
