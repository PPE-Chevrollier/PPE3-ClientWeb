<?php
session_start ();

require_once ('../class/pageBase.class.php');
require_once ('../class/pageSecurisee.class.php');
require_once ('../modele/communauteModele.class.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
    $pageInscriptionUser = new pageSecurisee ( "Inscription d'un utilisateur..." );
} else {
    $pageInscriptionUser = new pageBase ( "Inscription d'un utilisateur..." );
}

$pageInscriptionUser->script = 'jquery';
$pageInscriptionUser->script = 'jquery.validate.min';
$pageInscriptionUser->script = 'inscription';

$pageInscriptionUser->contenu = '<section>
                                    <article>
                                        <form id="formInscriptionUser" name="formInscriptionUser" method="post" action="../controleur/tt_InscriptionUser.php"> 
                                            <fieldset>
                                                <legend>Utilisateur</legend>
                                                <div class="form">
                                                    <label for="email">Email &nbsp;:&nbsp; </label>
                                                    <input type="text" name="email" id="email" class="email" />
                                                </div>		
                                                <div class="form">
                                                    <label for="pseudo">pseudo : </label>
                                                    <input  type="text" name="pseudo"  id="pseudo" />
                                                </div>     
                                                <div class="form">
                                                    <label for = "ListeCom"> Choisir une communautÃ© : </label>
                                                    <select name="ListeCom" id="ListeCom">';

                            $comMod = new communauteModele();
                            $listeCom = $comMod->getCommunautes();

                            foreach ($listeCom as $uneCom){
                                $pageInscriptionUser->contenu .= '<option  id="' . $uneCom->IDCO. '"  value="' . $uneCom->IDCO. '" />' . $uneCom->LIBELLE . '</option>';
                            }

                            $pageInscriptionUser->contenu .= '</select></div>
                                            </fieldset>
                                            <p><input class="submit" type="submit" value="Valider" /></p>
                                        </form>
                                    </article>		
                                </section>';
                                               
        $listeCom->closeCursor(); // pour libï¿½rer la mï¿½moire occupï¿½e par le rï¿½sultat de la requï¿½te
        $listeCom = null; // pour une autre exï¿½cution avec cette variable
						
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