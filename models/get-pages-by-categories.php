<?php

/**************************************************************************************************************/
/****** Nom : getPagesByCategories                                                                       ******/
/**************************************************************************************************************/
/****** Description : sélectionne les pages de la table "light_pages" dans la bdd pour une catégorie.    ******/
/**************************************************************************************************************/
/****** Paramètres : categorie et page (page ou s'affiche les données: l'accueil veut la dernière        ******/
/******              entrée de l'array des données de la database. On choisit un ordre croissant)        ******/
/****** [STRING] $category -> Nom de la catégorie: news, cours, tools, python, php...                    ******/
/****** Catégorie par défaut: news                                                                       ******/
/**************************************************************************************************************/
/****** Valeurs retournées : array avec toutes les entrées de la catégorie demandée                      ******/
/******                      les données sont classées différemment selon qu'elles seront affichées      ******/
/******                      dans un lexique (ordre alphabétique ou des news: ordre chronologique)       ******/
/**************************************************************************************************************/
/****** Auteur : Marc Harnist                                                                            ******/
/**************************************************************************************************************/
/****** Version : 1.0                                                                                    ******/
/**************************************************************************************************************/
/****** Créée le : 06/03/2018                                                                            ******/
/**************************************************************************************************************/
/****** Modifiée le : 13/03/2018                                                                         ******/
/**************************************************************************************************************/
function getPagesByCategories($category = "news", $page = "accueil")
{
    global $db;

	// The news are display from last to older
	if ($category == "news" && $page == ""){
		$sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY date DESC';
	}
	// The last news is called for the homepage
	elseif ($category == "news" && $page == "accueil"){
		$sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY id ASC';
	}
	// The lexicon is displayed by alphabetical order from A to Z (title)
	elseif ($category == "lexicon"){
		$sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY title ASC';
	}else{
		$sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category';
	}
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':category' => $category));
	$pages = $sth->fetchAll();

    return $pages;
}