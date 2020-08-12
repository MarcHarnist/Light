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

//Default config file
$config = 'public/config/config.php';//Owner and webmaster email, etc.

//Demo config file
$demoConfigFile = 'public/config/config-demo-24-questions.php';//Only Six pages
if(file_exists($demoConfigFile))
{
	//If the config demo has been installed in public/config : use it
	$config = $demoConfigFile;
}
$config_online = 'public/config/config-online.php';//Online configurations
$config_localhost = 'public/config/config-localhost.php';//Locahost configurations

//Owner and webmaster email, etc.
// file_exists($config)?require($config):print("<p>Fichier $config introuvable.</p>");
if(file_exists($config))
	require($config);
else
	echo "<p>Fichier $config introuvable.</p>";
if(isset($_SERVER['SCRIPT_URI'])){ //= online
	// Online configuration
	if(file_exists($config_online)) require($config_online);
	else echo "<p>Fichier $config_online introuvable.</p>";
}
else
{ 
	// We are on localhost on PC
	if(file_exists($config_localhost)) require($config_localhost);
	else echo "<p>Fichier $config_localhost introuvable.</p>";
}
