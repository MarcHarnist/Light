	<?php
/*
    Page Config-file-edition
									
	File : root/contoller/config-file-edition.php
	Author : Marc L. Harnist
	Date : 2020-07-02
	Do : receive model/config-file-reading-short-complete form/$_POST
	and work on them
*/
session_start();
include_once("models/class-uploader.php");
include_once("models/config-uploader.php");
$website = new Website();
$member  = $website::session();//$_Session['member'] avoid to create object $member.//VARIABLES


		    // var_dump($member);die();
$models   = ["config" => '../../models/config-uploader.php', "classes" => '../../models/class-uploader.php'];
$messages = [ "configImport"  => '<p>$models["config"] non trouvé.</p>', //config file not found
              "classesUpload" => '<p>$models["classes"] non trouvé</p>'];//classes uploader not found
//MODELS
// file_exists($models["config"])? require($models["config"]):exit($messages["configImport"]);//Import all config files
// file_exists($models["classes"])? require($models["classes"]):exit($messages["classesUpload"]);//Upload all classes
$website = new Website; //Website = config file. (To do : Remove and use models/config.php to ignore in Git)
$client  = $website::sessionClient();//$_Session['client'] avoid to create object $client.
$member  = $website::session();//$_Session['member'] avoid to create object $member.
$page    = new Page; //Use method "Get" to get page name and require controler and view with this name


	// VARIABLES /////////////////////////////////////////////////////////////////////////
	$pluginPath = "engine/config-manager";
	$model_1 = $pluginPath . "/config-file-form-post-treatment-model.php";//Model that will be used
	$model_2 = "ecrire-dans-un-fichier-model.php";//Model that will be used
	$file = "config-localhost";
	$filePath = "config/$file.php";
	$newContent = "";
	$level = 1;// Rights to see this page. 1 = webmaster or superAdmin only
	$methods = new Methods;//Get and store a lot of usefull methods in the var. $methods
	$database = new Database; // Connect to database and upload usefull methods (sql requests)
	$error = array();
	$error["connexion"] = "<p>Erreur 1 : Il faut être connecté en tant que super adminstrateur</p>";
	$error["importModel_1"] = "<p>Erreur 2 : import modèle ".$model_1."</p>";
	$error["importModel_2"] = "<p>Erreur 3 : import modèle ".$model_2."</p>";
	$message = ["warning" => "<h1>Warning 1 : Attention ! Continuer c'est altérer le fichier config !</h1>"];
	$lineHeader = "define('";
	$lineMiddle = "', '";
	$lineEnd    = "');";
	$dateCreation = "2020-07-01";
	$dateDuJour = date('Y-m-d'); // Replace by a automatic code
	$title = "CONFIG FILE";
	$author = "Marc Harnist";
	$thisFileName = "root/config/config-localhost.php";
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
	
	
	
// WARNING ! RESERVED TO ADMIN ONLY !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!	
	
	/////// DESACTIVE TEMPORELY /////////////////////////////////////////////////////
   isset($member)?$website->membersPermissions($level, $member):exit($error["connexion"]); 




	// Require model if exists, else, displays an error message.
	// is_file($model_1)?require($model_1):print($error["importModel_1"]);
	
	// Require model if exists, else, displays an error message.
	is_file($model_2)?require($model_2):print($error["importModel_2"]);
	// is_file($model_2)?"":require($model_2);

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
	// $message = $newContent;
	$message = writeInFile($filePath, $newContent);


	include_once("header.php");
	include_once("config-localhost-file-edition-view.php");