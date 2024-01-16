<?php
/** Contrôleur "page-delete-controller"
 *  @author : Marc Harnist
 *  Creation : 2017/08/09
 *  Updating : 2020/08/10
 *  This page reserved for level 1 & 2 users
 *  The users rights are checked in method setViewPath from class Page
 */
if(isset($_GET['id']) && !empty($_GET['id'])){
    //Get['id'] vient de la page page-index, ou page-from-page-index ou accueil
	$id = htmlspecialchars($_GET['id']);
	$database = new Database;//Connection à la base de données et à la classe Methods
	$currentPage = $database->getOnePageById($id); // On veut une seule page par son id
}

if(isset($_POST['id'])){
  $suppression = $database->delete($_POST['id']);
  if($suppression == True)
    header('Location: ' . $website->page_url . 'pages-index&categorie='.$currentPage['category']);
  else
	  exit("Il y a eu un problème.");
}
