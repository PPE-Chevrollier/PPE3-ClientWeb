<?php
/******************************fonction autoload **********************************************/
/* permet de charger les fichiers presents dans ce dossier */
function __autoload($nomClasse) {
	require_once $nomClasse . '.class.php';
}
