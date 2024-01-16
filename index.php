<?php
/** INDEX
*   Author  : Marc Harnist
*   Date    : 27/08/2018
*   MVC-OOP : all files imported here (classes, controlers, models, header, footer)
*/
session_start(); // Start a session for members and clients spaces
ini_set('display_errors',1); //Start Ovh php errors system

//Define and import models and classes uploader
$config = 'models/config-uploader.php';
$classes = 'models/class-uploader.php';
file_exists($config)? require_once($config):exit('"'.$config . '" not found.');
file_exists($classes)? require_once($classes):exit('"'.$classes . '" not found.');

$website = new Website; //Usefull method. Write website name in header
$client  = $website::sessionClient();//$_Session['client'] avoid to create object $client.
$member  = $website::session();//$_Session['member'] avoid to create object $member.
$page    = new Page; //Use method "Get" to get page name. Define controler and view pathes

//CONTROLERS for this page name
file_exists($page->getControllerPath()) AND require_once $page->getControllerPath();

//VIEW  header, footer for this page name. Other ideas: menu.php and categories.php.
file_exists($page->getHeaderPath()) AND require_once($page->getHeaderPath());
file_exists($page->getViewPath()) AND require_once($page->getViewPath());
file_exists($page->getFooterPath()) AND require_once($page->getFooterPath());