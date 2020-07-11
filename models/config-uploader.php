<?php
/**   File : model config_uploader
*     Path : root/models/config_uploader.php
*     Author : Marc Harnist
*     Date : 2020-06-30
*
*     This file is required in www.index.php
*     The website configuration is different on the web and in local
**/
// Function upload config files in root/index.php

$config = 'config/config.php';//Owner and webmaster email, etc.
$config_online = 'config/config-online.php';//Online configurations
$config_localhost = 'config/config-localhost.php';//Locahost configurations

//Owner and webmaster email, etc.
file_exists($config)?require($config):print("<p>Fichier $config introuvable.</p>");

if(isset($_SERVER['SCRIPT_URI'])){ //= online
	// Online configuration
	file_exists($config_online)?require($config_online):print("<p>Fichier $config_online introuvable</p><p>Message du fichier ". __FILE__ . " ligne "  . __LINE__ . ". <a href=\"http://marcharnist.fr/notebook/index.php?page=contact\">Merci de me le signaler...</a></p>");
}
else
{ 
	// We are on localhost on PC
	file_exists($config_localhost)?require($config_localhost):print("<p>Fichier $config_localhost introuvable.</p>");
}

