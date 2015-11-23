<?php 
if (!isset($_SESSION))
{
	session_start();
}


function addTachesAction($date, $tache, $categorie, $tag, $cible) {
	addTache($date, $tache, $categorie, $tag, $cible);
}

function modTacheAction($oldTache, $date, $tache, $categorie, $tag, $cible) {
	modTache($oldTache, $date, $tache, $categorie, $tag, $cible);
}

function deleteTachesAction($id) {
	deleteTache($id);
}

?>
