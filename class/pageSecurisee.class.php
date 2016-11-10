<?php
class pageSecurisee extends pageBase {
    public function __construct($t) {
            parent::__construct ( $t );
            $this->menu = ' <nav> 
                    <ul>
                            <a href=../vue/verifSessionOK.php>Déconnexion admin</a>
                            <a href="inscriptionUser.php"><li>Inscription</li></a>
                            <a href="consultationJeuxEtCommentaire.php"><li>Consultation des Commentaires par JV</li></a>
                            <a href="ajoutCommentaireJeux.php"><li>Ajouter un commentaire</li></a>
                            <a href="gestionCommentaire.php">Gestion des commentaires</a>
                    </ul>
                </nav>';
    }
}