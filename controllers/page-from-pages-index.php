<?php



if(isset($_GET['id']) && !empty($_GET['id'])){
    //Get['id'] vient de la page page-index, ou page-from-page-index ou accueil
	$id = htmlspecialchars($_GET['id']);
    $read = new Database;	// POO! $read = objet qui contient toute la table des pages
	$currentPage = $read->getOnePageById($id); // On veut une seule page par son id
	
	//Set a new page title for the html header in inc/header.php !
	$page->setTitle($currentPage['title']);
}

/** Permissions to display editions links in the view
*   Edition link: include_once(PUBLIC_PATH.'/inc/menu-edition.php');
*/
$editor = False;
if(isset($_SESSION['member']) && isset($member->level)) {
	if($member->level < 3)
	{
		$editor = True;
	}
}
