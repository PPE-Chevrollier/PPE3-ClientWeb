<?php
class pageBase {
    
    private $style = array ('modele', 'gestionERREUR'); // mettre juste le nom du fichier SANS l'extension css
    private $script = array ('utile'); // mettre juste le nom du fichier SANS l'extension js

    private $motsCles;
    private $description;
    private $titre;
    protected $entete;
    private $menu;
    private $contenu;
    private $piedpage;
    
    public function __construct($t) {
            $this->titre = $t;
            $this->description = 'notation des jeux videos';
            $this->motsCles = 'jeux videos,note,geek,informatique';
            $this->entete = '<header><a href="index.php"><img src="./image/jeux-videos-logo.jpg" alt="photos des pochettes de jeux videos"></a> NOTAGAME : noter vos jeux vid&eacute;os pr&eacute;f&eacute;r&eacute;s</header>';
            $this->menu = '<nav> 
                    <ul>
                            <a href="inscriptionUser.php"><li>s\'inscrire </li></a>
                            <a href="consultationJeuxEtCommentaire.php"><li>Consultation des Commentaires par JV</li></a>
                            <a href="ajoutCommentaireJeux.php"><li>Notation des jeux vidéos présents</li></a>
                    </ul>
            </nav>';
            $this->piedpage = '<footer>copyright 1FO SIO 49 Chevrollier : 1fo.sio.49@gmail.com - technologies mises en oeuvre PHP objet - MVC - jquery - Ajax </footer>';
    }

    public function __set($propriete, $valeur) {
            switch ($propriete) {
                    case 'motsCles' :
                            {
                                    $this->motsCles .= $valeur;
                                    break;
                            }
                    case 'style' :
                            {
                                    $this->style [count ( $this->style ) + 1] = $valeur;
                                    break;
                            }
                    case 'script' :
                            {
                                    $this->script [count ( $this->script ) + 1] = $valeur;
                                    break;
                            }
                    case 'titre' :
                            {
                                    $this->titre = $valeur;
                                    break;
                            }
                    case 'contenu' :
                            {
                                    $this->contenu = $valeur;
                                    break;
                            }
            }
    }
    
    public function __get($propriete) {
        if ($propriete == 'contenu') { return $this->contenu; }
    }
    /**
     * ****************************Gestion des mots clés *********************************************
     */
    /* Insertion des mots clés */
    private function charge_motsCles() {
            echo "<meta name='keywords' lang='fr' content='" . $this->motsCles . "' />";
            echo ("\n");
    }

    /**
     * ****************************Gestion de la description *********************************************
     */
    /* Insertion de la description du site */
    private function charge_description() {
            echo "<meta name='description' content='" . $this->description . "'/>";
            echo ("\n");
    }
    /**
     * ****************************Gestion des styles *********************************************
     */
    /* Insertion des feuilles de style */
    private function charge_style() {
            foreach ( $this->style as $s ) {
                    echo "<link rel='stylesheet' type='text/css' href='../vue/style/" . $s . ".css'/>";
                    echo ("\n");
            }
    }
    /**
     * ****************************Gestion des scripts *********************************************
     */
    /* Insertion des script JAVASCRIPT */
    private function charge_script() {
            foreach ( $this->script as $sc ) {
                    echo "<script type='text/javascript' src='../vue/script/" . $sc . ".js'></script>\n";
            }
    }
    /**
     * ****************************Gestion de l'entete *********************************************
     */
    protected function affiche_entete() {
            echo $this->entete;
            echo '<a href=../vue/verifSessionOK.php>Connexion</a>';
    }
    /**
     * ****************************Gestion de l'entete *********************************************
     */
    private function affiche_pied_page() {
            echo $this->piedpage;
    }
    /**
     * ****************************Gestion de l'entete *********************************************
     */
    protected function affiche_menu() {
            echo $this->menu;
    }
    /**
     * ****************************METHODE AFFICHER ******************************************************
     */
    public function afficher() {
		?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<title> <?php echo $this->titre;?> </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<?php $this->charge_motsCles();?>
	<?php $this->charge_description();?>
	<?php $this->charge_style();?>
	<?php $this->charge_script();?>
</head>
<body>
	<div id="global">
		<div id="entete"><?php $this->affiche_entete();?></div>
		<div id="navigation"><?php $this->affiche_menu();?></div>
		<div id="contenu"><?php echo $this->contenu;?></div>
		<div id="pied"><?php $this->affiche_pied_page();?></div>
	</div>
</body>
</html>
<?php
	}
}