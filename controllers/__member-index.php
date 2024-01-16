<?php
/**          Contrôleur __member-index
*               Marc L. Harnist
*                   28/08/2018
*
*   MAJ:
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

	$count=1;
	$ancre=0;
	
	$database = new Database;
	$db_table = TABLE_MEMBER;//Base de données
	$datas = $database->read_table($db_table);