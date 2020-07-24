<?php

// On demande toutes les pages qui ont une categorie "new"
$category = "news"; // default value: fonction default value doesn't work

// Get new category with $_GET from inc/header/nav links
if(isset($_GET['categorie']))
$category = htmlspecialchars($_GET['categorie']);

$read = new Database;	// POO! $lire = array() qui contient toute la table des pages

//List all categories
$pages = $read->getPagesByCategories($category, '', 300);
