<?php
header('Content-Type: text/html;charset=UTF-8');
require_once ('../modele/commentaireModele.class.php');

$json = array(); //tableau pour stocker les commentaires
$monModele = new commentaireModele();

if (isset($_POST['idU']) & isset($_POST['idJV'])){
    try{
        $monModele->update($_POST['idU'],$_POST['idJV'], $_POST['validation']); //Changement de l'état du commentaire
        
        $type = "";
        if ($_POST['validation'] == 2) $type = "refusé";
        else $type = "accepté";
        
        $json['success'] = ("SUCCESS : Commentaire ".$type." ! : <br/>");
    } catch ( PDOException $pdoe ) {
        $json['error'] = ("ERREUR : mise à jour ECHOUEE ! : <br/>" . $pdoe->getMessage ());
    }
}

echo json_encode($json);