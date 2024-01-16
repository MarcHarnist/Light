<?php
/**   Contrôleur creer-compte.php
*         Marc L. Harnist
*             2020
*
*   Programme de création d'un compte client
*
*   Base de donnée :$db_table = TABLE_CLIENT;//Base de données

*   Structure actuelle de la table:
*   - id
*   - civilite
*   - name
*   - password
*   - level
*
*   Les différents niveaux
*   1 Webmaster - Il peut ajouter des clients - tout faire
*   2 Propriétaire - Il peut modifier les pages du blog!
*   3 Modérateur
*   4 Membre
*   5 Client
*
*   Page publique
*/ 

/** PARAMETRES
*/
//Base de donnée
$db_table = TABLE_CLIENT;//Base de données

/** Espace de connexion si la création du compte a réussi
*/
$save_nom = "";

/** Message sur les travaux en cours. Ce message s'affiche dans le site *********
echo $website::message("Travaux du mardi 2 juin 2020", "Création des attribut du formulaire d'inscription dans la classe Client: firstname, téléphone... pour la  table \"clients\" (light_clients) dans la base de donnée parce que les attributs sont plus nombreux que l'espace membre.<br> 
<i><small>Message du fichier " . __FILE__ .  " à la ligne " . __LINE__ . ".</small></i>", "red");*/

//Vérifie que l'on vient bien de la bonne page.
if (isset($_POST['creer']) && $_POST['creer'] == "creation" 
	&& isset($_POST['civilite']) 
	&& isset($_POST['name']) 
	&& isset($_POST['firstname']) 
	&& isset($_POST['email']) 
	&& isset($_POST['pw']) 
	&& isset($_POST['phone']) 
	&& isset($_POST['capcha_reponse']) 
	&& isset($_POST['capcha']) 
	&& isset($_POST['level'])
	)
{
	/** Affiche des données utiles si besoin: décommenter pour activer. 
	*/
	// $clients_list      = new Database;//Connect to database and to class Methods
    // $clients_list->html_inside($_POST);//Bloque tout si html code inside
	// $liste_des_clients = $clients_list->read_table($db_table);

	$manager = new ClientsManager(); // New object with data base informations
	
	$message = new Message;//My first class self made ! 08/2017 Marc L.Harnist

	$messageSql = "";//Message si tentative d'injection sql

    //Empêche l'injection sql
	foreach($_POST as $key => $value)
	{
		//Efface le code sql : drop, truncate... dans le nom de la table
		$security = strtolower(Methods::cleanSqlCode($value));
		$value = strtolower($value);
		

    // var_dump($value);
    // var_dump($security);
	
		//Vérifie que le nom n'a pas été corrigé
		if($security !== $value)
		{
			switch($key)
			{
				case "civilite":
				    $key = "civilité";
					break;
				case "name":
					$key = "nom";
					break;
				case "firstname":
					$key ="prénom";
					break;
				case "email":
					$key ="email";
					break;
				case "pw":
					$key ="mot de passe";
					break;
				case "phone":
					$key ="téléphone";
					break;
				case "capcha_reponse":
					$key ="réponse au capcha";
					break;
			}
			//Crée un message d'erreur
			$messageSql .= '<p>Vous avez utilisé "<span style="color: red">' . $value . '</span>" pour le champ "' . ucfirst($key) . '" du formulaire.<br>';
			$messageSql .= "Vous pouvez utiliser des lettres et des chiffres uniquement.";
			$messageSql .= "</p>";
			
			$message->setRed($messageSql);
			break;//Sort du foreach
		}
	}
	if($messageSql === "") //Continue s'il n'y a pas de tentative d'injection sql
	{
		// Crée l'objet Client avec le nom qui doit être unique
		$nouveau_client = new Client(['name' => $_POST['name']]); // On crée un nouveau client.
		
		$nouveau_client->setCivilite($_POST['civilite']);//Genre du client pour les phrases du texte. Bienvenue madame...
		//name a été créé ci-dessus avec l'instanciation de la classe Client
		$nouveau_client->setFirstname($_POST['firstname']);
		$nouveau_client->setEmail($_POST['email']);
		$nouveau_client->setPassword($_POST['pw']);
		$nouveau_client->setPhone($_POST['phone']);
		$nouveau_client->setLevel($_POST['level']);
		$nouveau_client->setCapcha($_POST['capcha']);
		$nouveau_client->setCapchaReponse($_POST['capcha_reponse']);

		if (!$nouveau_client->nameValide()) {
			// cannot be empty
			$message->setRed("La case pseudo est vide: choisissez un pseudo.");
			unset($nouveau_client);
		}
		elseif ($manager->exists($nouveau_client->name())) {
			// go read in the dbtable if name is free
			$message->setRed("Ce nom est déjà pris. Merci de choisir un autre nom.");
			unset($nouveau_client);
		}
		elseif(!$nouveau_client->passwordValide()) {
		// cannot be empty
			$message->setRed("Vous avez oublié de choisir un mot de passe.");
			unset($nouveau_client);
		}
		elseif(!$nouveau_client->civiliteValide()) {
		// cannot be empty
			$message->setRed("Vous avez oublié de renseigner votre civilité, monsieur (Meur) ou madame (Mme).");
			unset($nouveau_client);
		}
		elseif(!$nouveau_client->capchaValide()) {
			//Traite le capcha
			$message->setRed("Erreur dans la réponse \"Je ne suis pas un robot.\"");
			unset($nouveau_client);
		}
		else { 
			// Everythings are ok. The client can be registered
			$hash = hash('ripemd160',$_POST['pw']);// the password is crypted for security!
			$nouveau_client->setPassword($hash);// hashed password registered in data base member
			
			//Special clients : level = 5
			$nouveau_client->setLevel(5);
			$manager->add($nouveau_client); // The name is free: create a new member in data base
		}
	}
}