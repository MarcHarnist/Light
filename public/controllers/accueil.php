<?php
/**          HOMEPAGE - ACCUEIL
*    
*    Class Database connect to db and display sql requests methods
*
*    Warning ! $database is used in inc/categories.php
*    If the variable name is changed, it must be changed in categories.php
*/
$database = new Database;
$currentPage = $database->getOneEntryById(TABLE_PAGES, 136);

$editorMenuDisplay = False;
if(isset($member) && $member->level <= 2)
	$editorMenuDisplay = True; //User has enough permissions
