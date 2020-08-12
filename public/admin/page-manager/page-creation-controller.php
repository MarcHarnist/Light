<?php
/** Controller "page creation controller" 
 *  @autor : Marc Laurent Harnist
 *  Creation : 2017/08/13
 *  Updating : 2020/08/10
 *
 *  This page reserved for level 1 & 2 users
 *  The users rights are checked in method setViewPath from class Page
 */

$date_default = date("d/m/Y"); 
	
$read = new Database;	// POO! $lire = array() qui contient toute la table des pages
	$categories = $read->list_categories(); // Méthode qui liste les catégories existantes dans les pages
	$last_id = $read->last_id(); // Last id create - dernier id créé toutes catégories confondues pour redirection finale
