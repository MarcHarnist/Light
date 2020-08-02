<?php
/**                      Contrôleur __client-delete
*                            Marc L. Harnist
*                              06/03/2020
*   MAJ:
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

/** Connexion à la base de donnée
*/  $database = new Database;

/** Déclaration des variables
*/  $ancre = $confirm = $id = "";
    $table = TABLE_CLIENT;

// Je récupère les données du formulaire
if(isset($_POST['confirm'])) $confirm = $_POST['confirm'];

// Have we confirm delete ?
if($confirm == "oui") {
	$database = $database->light_clients("delete", $_POST);
	$url= $website->page_url . '__client-index#' . $database['ancre']; //$id est l'ancre de retour...
	header("Location:$url");
}
else {
	$database = $database->light_clients("select", $_POST);
	$id = $database['id'];
	$name = $database['name'];
	$ancre = $database['ancre'];
	$url_de_retour_en_arriere = $website->page_url . '__client-index#' . $ancre;
}
