<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/commentaireModele.class.php');

$json = array(); //tableau pour stocker les commentaires
$monModele = new commentaireModele ();

if (isset($_GET['idU']) & isset($_GET['idJV'])){
	//requete presente dans le modele qui supprime les commentaires avec la cle fournie
	try{
		$monModele->update($_GET['idU'],$_GET['idJV'], $_GET['validation']);
		$json['success'] = ("SUCCESS : Commentaire retirée ! : <br/>");
	} catch ( PDOException $pdoe ) {
		$json['error'] = ("ERREUR : Suppression ECHOUEE ! : <br/>" . $pdoe->getMessage ());
	}
}
echo json_encode($json);