<?php
/**
*   Model
*                       
*   File : root/models/error-message.php
*   Author : Marc Harnist for Mydataball
*   Date : 2020-07-03
*   
*   Theme
*   Use array and boolean for several error messages
*/    
	// VARIABLES //
	$requireModelSucces["requireModel"] = [True => "Fichier bien importé.", False => "Le fichier à importer est introuvable."]; // Message for "requireModelSucces"
	$model = "models/config-file-reading-short-complete.php"; //File to import

	// ACTIONS //
    is_file($model)?print($requireModelSucces[True]):exit($requireModelSucces[False]);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
