<?php
/** INDEX.PHP
*   Author  : Marc Harnist
*   Date    : 27/08/2018
*   MVC-OOP : all files imported here (classes, controlers, models, header, footer)
*/
session_start(); // Start a session for members and clients spaces
ini_set('display_errors',1); //Start Ovh php errors system

//VARIABLES
$models   = ["config" => 'models/config-uploader.php', "classes" => 'models/class-uploader.php'];
$messages = [ "configImport"  => '<p>$models["config"] non trouvé.</p>', //config file not found
              "classesUpload" => '<p>$models["classes"] non trouvé</p>'];//classes uploader not found
//MODELS
file_exists($models["config"])? require($models["config"]):exit($messages["configImport"]);//Import all config files
file_exists($models["classes"])? require($models["classes"]):exit($messages["classesUpload"]);//Upload all classes
$website = new Website; //Website = config file. (To do : Remove and use models/config.php to ignore in Git)
$client  = $website::sessionClient();//$_Session['client'] avoid to create object $client.
$member  = $website::session();//$_Session['member'] avoid to create object $member.
$page    = new Page; //Use method "Get" to get page name and require controler and view with this name

//CONTROLERS
//Import controler if exists for this page name or exit an display an error message
file_exists($page->getControllerPath())? include_once $page->getControllerPath():exit($page->getControllerPath().' existe?');

//VIEW
//Import header, view and footer if exist or displays error message. (Can import menu.php, categories.php...)
file_exists($page->getHeaderPath())?require_once($page->getHeaderPath()): exit($page->getHeaderPath().' existe?');
file_exists($page->getViewPath())?require($page->getViewPath()): exit($page->getViewPath().' exixte?');
file_exists($page->getFooterPath())?require($page->getFooterPath()): exit($page->getFooterPath().' existe?');
