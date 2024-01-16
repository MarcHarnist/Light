<?php
/**   Contrôleur __member_register
*         MH - Mai 2020
*
*	Cette page est réservée aux membres de niveau 1 et 2 dans le CMS.
*
*   Les différents niveaux
*   1 Webmaster - Il peut ajouter des membres - tout faire
*   2 Propriétaire - Il peut modifier les pages du blog!
*   3 Modérateur
*   4 Membre
*   5 Client
*/

$website->membersPermissions(2, $member);
$db_table = TABLE_MEMBER;//Base de données

if (isset($_POST['creer']) && isset($_POST['name']) && isset($_POST['pw']) && isset($_POST['level'])) {
	$message           = new Message;//My first class self made ! 08/2017 MarcL.Harnist
	$members_list      = new Database;//Connect to database and to class Methods
    $members_list->html_inside($_POST);//Bloque tout s'il y a du code html à l'intérieur
	$liste_des_membres = $members_list->read_table($db_table);
	$manager           = new MembersManager(); // New object with data base informations
    
    // Create OOP objects
    $new_member = new Member(['name' => $_POST['name']]); // On crée un nouveau membre.
    $new_member->setPassword($_POST['pw']);//ajoute le mot de passe à l'objet
	
	//vérifie que le nom du membre est renseigné. Sinon, il l'objet membre est détruit.
    if (!$new_member->nameValide()) {
        // cannot be empty
        $message->setRed("La case pseudo est vide: choisissez un pseudo.");
        unset($new_member);
    }
    elseif ($manager->exists($new_member->name())) {
        //vérifie qu'il n'y a pas déjà de membre avec ce nom là. Si oui, l'objet membre est détruit.
        $message->setRed("Le nom du membre est déjà pris. Merci de choisir un autre nom.");
        unset($new_member);
    }
    elseif(!$new_member->passwordValide()) {
		//vérifie qu'un mot de passe a été renseigné. Sinon, l'objet membre est détruit.
        $message->setRed("Vous avez oublié de choisir un mot de passe.");
        unset($new_member);
    }
    else { 
        //Tout est bien renseigné, le membre est enregistré dans la base de donnée.
        $hash = hash('ripemd160',$_POST['pw']);//crypte le mot de passe.
        $new_member->setPassword($hash);//met à jour le mot de passe dans l'objet membre.
        $new_member->setLevel($_POST['level']);
        $manager->add($new_member); //ajoute le membre à la base de donnée.
    }
}