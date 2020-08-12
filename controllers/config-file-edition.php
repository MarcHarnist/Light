	<?php
/*
    Page Config-file-edition
									
	File : root/contoller/config-file-edition.php
	Author : Marc L. Harnist
	Date : 2020-07-02
	Do : receive model/config-file-reading-short-complete form/$_POST
	and work on them
*/

	// VARIABLES /////////////////////////////////////////////////////////////////////////
	$model_1 = "models/config-file-form-post-treatment.php";//Model that will be used
	$model_2 = "models/ecrire-dans-un-fichier.php";//Model that will be used
	$file = "config";
	$filePath = CONFIG_PATH;
	$newContent = "";
	$level = 1;// Rights to see this page. 1 = webmaster or superAdmin only
	$methods = new Methods;//Get and store a lot of usefull methods in the var. $methods
	$database = new Database; // Connect to database and upload usefull methods (sql requests)
	$error = ["connexion" => "Erreur : Il faut être connecté en tant que super adminstrateur"];
	$error = ["importModel_1" => "<p>Erreur import modèle ".$model_1."</p>"];
	$error = ["importModel_2" => "<p>Erreur import modèle ".$model_2."</p>"];
	$message = ["warning" => "<h1>Attention ! Continuer c'est altérer le fichier config !</h1>"];
	$lineHeader = "define('";
	$lineMiddle = "', '";
	$lineEnd    = "');";
	$dateCreation = "2020-07-01";
	$dateDuJour = date('Y-m-d'); // Replace by a automatic code
	$title = "CONFIG FILE";
	$author = "Marc Harnist";
	$thisFileName = "root/config/config.php";
	$introduction = "website constants";
	$newContent = "";//Create a new content for writting in a file
	$newContentHeader = "<?php";
	$newContentHeader .= "\n";
	$newContentHeader .= "/**  " . $title;
	$newContentHeader .= "\n";
	$newContentHeader .= "*    File : " . $thisFileName;
	$newContentHeader .= "\n";
	$newContentHeader .= "*    Author : " . $author;
	$newContentHeader .= "\n";
	$newContentHeader .= "*    Date de création : " . $dateCreation;
	$newContentHeader .= "\n";
	$newContentHeader .= "*    Date mise à jour : " . $dateDuJour;
	$newContentHeader .= "\n";
	$newContentHeader .= "*    Content : " . $introduction;
	$newContentHeader .= "\n";
	$newContentHeader .= "**/";
	$newContentHeader .= "\n";
	$newContentHeader .= "\n";

	// ACTIONS
	// Redirect user to homepage if not enought rights and if $member is set
	isset($member)?$website->membersPermissions($level, $member):exit($error["connexion"]); 

	// Require model if exists, else, displays an error message.
	// is_file($model_1)?require($model_1):print($error["importModel_1"]);
	
	// Require model if exists, else, displays an error message.
	is_file($model_2)?require($model_2):print($error["importModel_2"]);

	//Add header to content
	$newContent .= $newContentHeader;
	//Builds lines with header, middle, and end line

	foreach($_POST as $key => $value)
	{
		if (strpos($key, "/comment") === False)
			$newContent .= $lineHeader . $key . $lineMiddle . $value . $lineEnd;
		else		
			$newContent .= "//".$value ."\n";
	}
	//Lauch the writting function from models/ecrire-dans-un-fichier (write-in-a-file)
	$message = writeInFile($filePath, $newContent);
	
	//You can test crash code bellow to display messages line 71
		// $message = writeInFile("", $newContent);
		// $message = writeInFile($filePath, "");
	
