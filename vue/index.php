<?php
session_start();

require_once('../class/pageBase.class.php');
require_once('../class/pageSecurisee.class.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
    $pageIndex = new pageSecurisee("Bienvenue sur NotaGAME...");
} else {
    $pageIndex = new pageBase("Bienvenue sur NotaGAME...");
}

$pageIndex->contenu = '
        <section>
		<article>
			<img src="./image/jeux-videos.jpeg" alt="photos des pochettes de jeux videos">
		</article>
	</section>';				

$pageIndex->afficher();