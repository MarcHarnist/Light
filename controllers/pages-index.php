<?php

// On demande toutes les pages qui ont une categorie "new"
$category = "news"; // default value: fonction default value doesn't work
$editor_display = False;

// Get new category with $_GET from inc/header/nav links
if(isset($_GET['categorie']))
$category = htmlspecialchars($_GET['categorie']);

$read = new Database;	// POO! $lire = array() qui contient toute la table des pages

//List all categories
$pages = $read->getPagesByCategories($category, '', 300);

//User rights for edition
if(isset($member) && $member->level <= 2)
	$editor_display = True; //User has enough permissions

//For inc/menu-categories.php
$categories = $read->list_categories(); 