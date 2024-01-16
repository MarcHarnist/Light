<?php
/**             Contrôleur __client-update
*                   Marc L. Harnist
*                       28/05/2020
**/ 

 //Limité au webmaster : 1
 $website->membersPermissions(2, $member);


  $message = new Message;
  $db_table = TABLE_CLIENT;//Base de données - TABLE_CLIENT: see config/config.php
  $update = new Database;
  $resultat = $update->update_table_clients($db_table, $_POST);
  if($resultat === true)
  {
	/**   AFFICHAGE DES NEWS SUR LES TRAVAUX EN COURS      */
	
	echo $website->message("Travaux en cours", "Gestion de la redirection en cas de modification réussie.", "lightgreen");
	

	header ('Location: ' . $website->redirection('__client-index'));

	$message->setGreen("Modification réussie.");
  }	
  
