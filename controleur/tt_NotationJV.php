<?php
require_once ('../modele/commentaireModele.class.php');
require_once ('../modele/userModele.class.php');

$msgERREUR = "";

if (isset($_POST['email']) && isset($_POST['pseudo'])) {
    $modeleUser = new userModele();
    // recuperation de l'identifiant de l'utlisateur avec son email et son pseudo
    $resultU = $modeleUser->getUser($_POST['email'], $_POST['pseudo']);
    if ($resultU->rowCount() == 0) {
        // cas ou l'email ou le pseudo ne sont pas valides (retour du count)
        $msgERREUR = "ERREUR : votre email et/ou pseudo ne sont pas valides ! :" ;
    } else {
        //un seul tuple donc inutile de faire un foreach, on prend juste le tuple courant
        $idU = $resultU->fetch()->IDU ;

        if (isset ($_POST['radioJV']) && isset($_POST['comments']) && isset($_POST['agree'])) {
            // ajout du commentaire en récupérant l'Id du jeu (ici dans radioJV)
            $modeleCom = new CommentaireModele();
            try {
                //pour traiter les eventuelles apostrophes dans la chaine des commentaires
                $chaineCommentaire = addslashes($_POST ['comments']);

                $nb = $modeleCom->add($idU, $_POST['radioJV'], $chaineCommentaire, $_POST['notesA']);
                $msgERREUR = "SUCCESS : AJOUT du commentaire reussi";
            } catch (PDOException $pdoe) {
                // cas ou 2 pseudo ont deja mis un commentaire sur un jeu
                $msgERREUR = "ERREUR : vous avez déjà effectué un commentaire pour ce jeu ! : <br/>" . $pdoe->getMessage ();
            }
        }
    }
}

// redirection vers la page appelante en lui passant le message
header ( 'Location: ../vue/ajoutCommentaireJeux.php?error='.$msgERREUR );