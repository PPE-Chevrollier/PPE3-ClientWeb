<?php
class pageSecurisee extends pageBase {
    public function __construct($t) {
            parent::__construct ( $t );
    }

    /**
     * ****************************Gestion de l'entête *********************************************
     */
    // REDEFINITON de l'entête par rapport à celui de page_base
    protected function affiche_entete() {
            echo $this->entete;
            echo '<a href=../vue/verifSessionOK.php>Déconnexion</a>';
    }

    /**
     * ****************************Gestion du menu *********************************************
     */
    // REDEFINITON du menu par rapport à celui de page_base
    protected function affiche_menu() {
            parent::affiche_menu ();
            // on met ici les pages qui sont sécurisées
            // on rajoute dans le MENU une nouvelle page !
            ?>
<ul>
	<li><a href="supprCommentaire.php">Supprimer les commentaires</a></li>
</ul>

<?php
	}
}