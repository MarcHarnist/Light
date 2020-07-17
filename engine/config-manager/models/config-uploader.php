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
$configPluginsPath = '../../config/config.php';//Owner and webmaster email, etc.
$config_online = 'config/config-online.php';//Online configurations
$config_onlinePluginsPath = '../../config/config-online.php';//Online configurations
$config_localhost = 'config/config-localhost.php';//Locahost configurations
$config_localhostPluginsPath = '../../config/config-localhost.php';//Locahost configurations

//Owner and webmaster email, etc.
// file_exists($config)?require($config):print("<p>Fichier $config introuvable.</p>");
if(file_exists($config))
	require($config);
elseif(file_exists($configPluginsPath))
	require($configPluginsPath);
else
	echo "<p>Fichier $config introuvable.</p>";

if(isset($_SERVER['SCRIPT_URI'])){ //= online
	// Online configuration
	if(file_exists($config_online)) require($config_online);
	elseif(file_exists($config_onlinePluginsPath)) require($config_onlinePluginsPath);
	else echo "<p>Fichier $config_online introuvable.</p>";
}
else
{ 
	// We are on localhost on PC
	if(file_exists($config_localhost)) require($config_localhost);
	elseif(file_exists($config_localhostPluginsPath)) require($config_localhostPluginsPath);
	else echo "<p>Fichier $config_localhost introuvable.</p>";
}
