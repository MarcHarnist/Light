<?php
/**          Contrôleur __client-index
*               Marc L. Harnist
*                   28/08/2018
*
*   MAJ:
*   Autorisation limitée au webmaster
*/ 
$website->membersPermissions(1, $member);

	$count=1;
	$ancre=0;
	
	$database = new Database;
	$datas = $database->read_table(TABLE_CLIENT);//TABLE_CLIENT: see config/config.php


