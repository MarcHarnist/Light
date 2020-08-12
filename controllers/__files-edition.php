<?php
/**             Controlleur  __files-edition
*							
*	Système d'édition de fichiers
*	13/08/2017
*	ML-Harnist
*/
$website->membersPermissions(2, $member);
$getFile = "NoFileDefined";
if(isset($_GET['file']))
{
	$getFile = $_GET['file'];
	$getFile = str_replace("../", "", $getFile);
}
$getFilePathCopy = $getFile;
$getFilesManager = new FilesManager;	// POO! $getFilesManager : already empty object

// Function file_readers returns an array with file content or false if file not found
$fichier_en_cours_de_lecture = $getFilesManager->file_reader($getFile);

//On wamp?
if($fichier_en_cours_de_lecture === False)
	$getFilePathCopy = str_replace("/", "\\", $getFilePathCopy);

$fichier_en_cours_de_lecture = $getFilesManager->file_reader($getFilePathCopy);
    // var_dump($getFilePathCopy);
if($fichier_en_cours_de_lecture == False)
{
	$falsePath = "wamp64\www\\" . DOMAIN;//DOMAIN is defined in config/config.php
	$newPath = "wamp64\www\marcharnist\www\\" . DOMAIN;
	$getFilePathCopy = str_replace($falsePath, $newPath, $getFilePathCopy);
}	
$fichier_en_cours_de_lecture = $getFilesManager->file_reader($getFilePathCopy);

if($fichier_en_cours_de_lecture == False)
{
	$falsePath = "www\\" . DOMAIN;//DOMAIN is defined in config/config.php
	$newPath = "www\\" . DOMAIN . "\\" . DOMAIN;
	$getFilePathCopy = str_replace($falsePath, $newPath, $getFilePathCopy);
}	
$fichier_en_cours_de_lecture = $getFilesManager->file_reader($getFilePathCopy);

if($fichier_en_cours_de_lecture == False)
{
	exit("Le fichier: <span style=\"color:blue;\">\"$getFile\"</span> est introuvable.<br>Vérifiez le chemin! Il manque peut-être \"www/\" dans la vue \"__explorer\"");
}

$getFile = $getFilePathCopy;
$fileElements = array();

//test
// $getFile = "\wamp64\www\light\css\style.css";

if(strpos($getFile, "/") === False)
{
	if(strpos($getFile, "\\") !== False)
	{
		$fileElements = explode("\\",$getFile);
	}
}
else
{
	$fileElements = explode("/",$getFile);
}
$fileName = end($fileElements);

if(isset($_GET['operation']) && $_GET['operation'] == "supprimer")
{
	$fichier_en_cours->supprimer_le_fichier($getFile);
	header("Location:  " . $website->redirection("__explorer#php") . "");
	exit();
}
