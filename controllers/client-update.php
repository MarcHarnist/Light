<?php
/**             Contrôleur client-update
*                   Marc L. Harnist
*                       28/05/2020
*
*   Autorisation limitée aux clients connectés
*/  $website->clientsPermissions(5, $client);

  $message = new Message;
  $db_table = TABLE_CLIENT;//Base de données
  $update = new Database;
  $resultat = $update->update_table_clients($db_table, $_POST);

/**   AFFICHAGE DES NEWS SUR LES TRAVAUX EN COURS      */
echo $website->message("Travaux en cours", "Gestion de la redirection en cas de modification réussie.", "lightgreen");

if($resultat === true)
{
	$message->setGreen("Modification réussie.");
}
else
{
  	$message->setRed("Erreur de modification");
}	
header ('Location: ' . $website->redirection('client-index'));
