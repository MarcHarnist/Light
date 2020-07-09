<?php
/**          Contrôleur client-index
*               Marc L. Harnist
*                   28/08/2018
*
*   MAJ:
*   Autorisation limitée au webmaster
*/  $website->clientsPermissions(5, $client);

	$count=1;
	$ancre=0;
	
	$database = new Database;
	$datas = $database->read_table(TABLE_CLIENT);


	//cherche si un client est connecté
	if(isset($client) && null !== $client->id() && is_int($client->id()))
	{
		$client_en_cours_de_lecture = $database->getOneClientById($client->id()); // On veut un seul client par son id

	}
	else
	{
		echo 'Problème de données';
	}
