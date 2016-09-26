<?php
require_once ('../modele/contactModele.class.php');?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>
<?php
$retour = '<table border="1"><tr><th>Nom</th><th>Prenom</th><th>Mail</th><th>NomSociete</th><th>VilleSociete</th><th>Fonction</th></tr>';

$monModele = new contactModele();
$liste = $monModele->getContactS(); // APPEL de la methode getContactS qui retourne tous les contacts

foreach ($liste as $unContact) {
	$retour .= '<tr><td>' . $unContact->nom . '</td><td>' . $unContact->prenom . '</td><td>' . $unContact->mail . '</td><td>' . $unContact->nomSociete . '</td><td>' . $unContact->villeSociete . '</td><td>' . $unContact->fonction . '</td></tr>';
}

$retour .= '</table>';

$liste->closeCursor(); // pour liberer la memoire occupee par le resultat de la requete
$liste = null; // pour une autre execution avec cette variable
?>
</html>
