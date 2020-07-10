<?php
/**             Contrôleur client-update
*                   Marc L. Harnist
*                       28/05/2020
*
*   Autorisation limitée au webmaster
*/  
	$rightLevelThisPage = 1;// 1 = only administrator
	
	/* @var $message Type array used to display a message in case of false import or other operation */  
	$message["adminOnly"] = "Il faut être connecté en tant qu'administrateur du site web";

	isset($member)?$website->membersPermissions($rightLevelThisPage, $member):exit($message["adminOnly"]); 
