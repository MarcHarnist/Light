<?php

/** Controller "page update controller"
 *  Creation : 2017/08/13
 *  Updating : 2020/08/10
 *
 *  This page reserved for level 1 & 2 users
 *  The users rights are checked in method setViewPath from class Page
 */

$read = new Database;	// POO! $read = objet qui contient toute la table des pages

$id = null;
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id = htmlspecialchars($_GET['id']);
}
$pages      = $read->getOnePageByIdToUpdate($id); // On veut une seule page par son id
$categories = $read->list_categories(); // Méthode qui liste les catégories existantes dans les pages
					
// Si une image a été uploadé / if an image has been uploaded
if(isset($_GET['image'])){
	$image = $_GET['image'];
	$image = '<img class="w-100" src="' . $website->img_url . $image . '" alt="' . $image . '">';
}
