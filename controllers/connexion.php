<?php
/*************************************************** 
*	This file is installed in "controller"	directory
*	Marc Harnist 2017/10/08
*
*****************************************************/

//VARIABLES UTILES
$url_admin_index = 'admin';// backoffice. Admin url is defined in root/.htaccess
$url_accueil = $website->page_url . 'accueil';


//Autres variables utiles
$save_nom = "";
$message = new Message;// My first class self made ! 08/2017 MarcL.Harnist
$db_table = TABLE_MEMBER;//Base de données


// Si on a voulu se connecter.
if (isset($_POST['utiliser']) && isset($_POST['name']) && isset($_POST['password'])){
	// Si on a voulu se connecter.
	$read_members = new Database;	
	$read_members->html_inside($_POST);//bloque tout s'il y a du code html
	$members = $read_members->read_table($db_table);
	$save_nom = $_POST['name'];//sauvegarde le pseudo dans une nouvelle variable
	$manager = new MembersManager(); // New object with data base informations

	//verifie que le nom est renseigné dans le formulaire
	if(empty($_POST['name'])){
		//sinon, crée un message pour l'utilisateur
		$message->setRed("Choisissez un pseudo");
		//détruit l'objet membre
		unset($member);
	}
	//verifie que le mot de passe est renseigné dans le formulaire
	if(empty($_POST['password'])){
		//sinon, crée un message pour l'utilisateur
		$message->setRed("Vous avez oublié de renseigner le mot de passe.");
		//détruit l'objet membre
		unset($member);
	}
	elseif ($manager->exists($_POST['name'])){	
		// Si le membre existe dans la base de donnée
		$member = new Member(['name' => $_POST['name']]); // On crée l'objet "membre" avec son nom.
		$hash = hash('ripemd160',$_POST['password']);//on récupère le mot de passe renseigné dans le formulaire
		$member = $manager->get($save_nom);//on récupère le mot de passe de la base de donnée pour ce nom
		$hash_db = $member->password();//on crée une variable "hash_db" qui contient le mot de passe de la base de donnée
		//compare les deux mots de passe: celui du formulaire renseigné par l'utilisateur qui veut se connecter et celui de la base de donnée
		if($hash_db === $hash)
			{
			//Les deux mots de passe sont identiques, on continue
			$member = $manager->get($_POST['name']);// $member : string
			//crée une session avec ce membre en mémoire.
			$_SESSION['member'] = $member;//$member = string 'nom du membre'. Ex: 'Marc'		
		}
		else {
			$erreur_pw = True;
			$message->setRed("Mot de passe érroné...</h3>");
			unset($member);
		}
	}
	else {
		$erreur_nom = True;
		// S'il n'existe pas, on affichera ce message.
		$message->setRed("Erreur dans le nom. <a href=\" " . $website->page_url . "contact\">Contactez-nous.</a>");
	}
}
if(isset($member) && $member != NULL){
	//Redirige le membre connecté à l'accueil de l'administration du site (pour connexion-client vers l'accueil)
	header('Location: ' . $url_admin_index);
}
else{
// Si le membre n'existe pas dans la base de donnée on déconnecte tout
   unset($member); // The member do not exists in database but still in the navigator memory. We empty it.
   unset($_SESSION['member']); // same action to session memory

	// On ne supprime pas la connexion des clients
	//Vérifie qu'une cession client n'existe pas
	// if(!$client)
		// session_destroy(); // close de session
}