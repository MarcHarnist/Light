<?php
/**
*   Page-save = enregistrement des pages dans la base de donnée
*   13/08/2017 Marc Laurent Harnist
*   Ce fichier modifié en POO le 18/07/18
*   Nous arrivons ici depuis pages-edition.php et pages-creation via méthode form / POST
*   Les valeurs de la super globale $_POST sont traités dans
*   la class root/classes/DatabaseCreate.php
*   We arrive here from the file: view/pages-edition.php & view/pages-creation
*   The values of the global $_POST are in the class root/models/classes/DatabaseCreate treated
**/
$website->membersPermissions(1, $member);
$database = new Database;
$database->update_article($_POST);

if($database == True)
{
	//no error, we continue...
	header ('location: ' . $website->page_url . 'pages-edition&id=' . $database->N°);
	exit();
}

// else: form == False: there's an error: the view is load here by root/index.php...