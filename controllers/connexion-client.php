<?php
/*************************************************** 
*	This file is installed in "controller"	directory
*	Marc Harnist 2017/10/08
*
*****************************************************/

//VARIABLES UTILISEES DANS LA VUE
$save_nom = ""; //Sauvegarde le nom car $nom est modifié en cours de code.
$message = new Message;// My first class self made ! 08/2017 MarcL.Harnist
$db_table = TABLE_CLIENT;//Base de données

// Si on a voulu se connecter.
if (isset($_POST['utiliser']) && isset($_POST['name']) && isset($_POST['password'])){
	$read_clients = new Database;
	$read_clients->html_inside($_POST);//bloque tout s'il y a du code html
	// $clients = $read_clients->read_table($db_table);
	$save_nom = $_POST['name'];//sauvegarde le nom dans une nouvelle variable
	$manager = new ClientsManager(); // New object with data base informations
	//verifie que le nom est renseigné dans le formulaire
	if(empty($_POST['name'])){
		//sinon, crée un message pour l'utilisateur
		$message->setRed("Choisissez un nom");
		//détruit l'objet membre
		unset($client);
	}
	//verifie que le mot de passe est renseigné dans le formulaire
	if(empty($_POST['password'])){
		//sinon, crée un message pour l'utilisateur
		$message->setRed("Vous avez oublié de renseigner le mot de passe.");
		//détruit l'objet membre
		unset($client);
	}
	elseif ($manager->exists($_POST['name'])){	
		// Si le membre existe dans la base de donnée
		$client = new Client(['name' => $_POST['name']]); // On crée l'objet "membre" avec son nom.
		$hash = hash('ripemd160',$_POST['password']);//on récupère le mot de passe renseigné dans le formulaire
		$client = $manager->get($save_nom);//on récupère le mot de passe de la base de donnée pour ce nom
		$hash_db = $client->password();//on crée une variable "hash_db" qui contient le mot de passe de la base de donnée
		//compare les deux mots de passe: celui du formulaire renseigné par l'utilisateur qui veut se connecter et celui de la base de donnée
		if($hash_db === $hash)
			{
			//Les deux mots de passe sont identiques, on continue
			$client = $manager->get($_POST['name']);// $client : string
			
			//crée une session avec ce membre en mémoire.
			$_SESSION['client'] = $client;//$client = string 'nom du membre'. Ex: 'Marc'		
		}
		else {
			$erreur_pw = True;
			$message->setRed("Mot de passe érroné...</h3>");
			unset($client);
		}
	}
	else {
		$erreur_nom = True;
		// S'il n'existe pas, on affichera ce message.
		$message->setRed("Erreur dans le nom. <a href=\" " . $website->page_url . "contact\">Contactez-nous.</a>");
	}
}
if(isset($client) && $client != NULL){
	//Redirige le membre connecté. Ici au tableau-de-bord.
	header('Location: ' . $website->redirection('tableau-de-bord'));
}
else{
// Si le membre n'existe pas dans la base de donnée on déconnecte tout
   unset($client); // The client do not exists in database but still in the navigator memory. We empty it.
   unset($_SESSION['client']); // same action to session memory

   //La session n'est plus détruite pour conserver la connexion à l'espace membre
   // session_destroy(); // close de session
}