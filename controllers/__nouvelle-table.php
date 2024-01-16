<?php
		/** Fichier: controllers / __nouvelle-table.php
		*               Marc L. Harnist
		*                08 Juin 2020
		*              MAJ 11 juin 2020
		*
		*  Réservé aux membres
		*/
		$website->membersPermissions(2, $member);// 2 = level of permission = owner (2) and webmaster 1), $member = object

	if(isset($message)) unset($message);

	//Cherche si une variable post existe
	if(isset($_POST) && !empty($_POST) && isset($_POST['operation']) )
	{
		//Crée un message vide
		$message = "<h6>Message du contrôleur \"__nouvelle-table\" :</h6>";

		//Crée l'objet Database avec toutes ses méthodes CRUD
		$database = new Database();

		//Regarde si une "opération" a été déclaré en "création"
		if($_POST['operation'] == "creation")
		{
			//Ajoute "création" au message
			$message .= __LINE__ . " Message de création :<br>";

			//Affiche ce qui est posté par le formulaire envoyé
				// var_dump($_POST);
				// var_dump($_POST['operation']);
				// var_dump($_POST['nom_de_la_table']);

			//Vérifie que le nom_de_la_table a été posté
			if(isset($_POST['nom_de_la_table']) && null !== $_POST['nom_de_la_table'] && !empty($_POST['nom_de_la_table']) && $_POST['nom_de_la_table'] !== '')
			{
				$nom_de_la_table = strtolower($_POST['nom_de_la_table']);
				$message .= __LINE__ . " Le nom de la table est renseigné.<br>";
				$message .= __LINE__ . " Nom de la table : \"" . $_POST['nom_de_la_table']."\"<br>";
				$message .= __LINE__ . " Opération: \"" . $_POST['operation'] . "\"<br>";

				//Efface le code sql : drop, truncate... dans le nom de la table
				$security = strtolower(Methods::cleanSqlCode($nom_de_la_table));
				
				//Vérifie que le nom n'a pas été corrigé
				if($security !== $nom_de_la_table)
				{
					//Crée un message d'erreur
					$message .= " <span style=\"color: red\">Vous ne pouvez pas utiliser les mots suivants : ";
					
					//Ajoute dans le message les noms interdits
					foreach(Methods::$sqlMotsInterdits as $motInterdits){
						$message .= $motInterdits . ", ";
					}
					$message .= "</span>";
				}
				//N'accepte que les lettres dans le nom
				elseif(ctype_alpha($nom_de_la_table) === false) 
				{
					//Crée un message d'erreur
					$message .= " <span style=\"color: red\">Le nom doit comporter uniquement des lettres.</span>";
				}
				//Vérifie que le nom contient au moins deux caractères
				elseif(strlen($nom_de_la_table)<3)
				{
					//Crée un message d'erreur parce que le mot est trop court
					$message .= " <span style=\"color: red\">Le nom doit comporter au moins trois caractères.</span>";
				}
				//Vérifie que le nom n'est pas déjà pris dans la db
				elseif($database->table_exists($nom_de_la_table) === true)
				{
					//Crée un message d'erreur parce qu'une table existe déjà avec ce nom.
					$message .= " <span style=\"color: red\">Une table existe déjà avec ce nom.</span>";
				}
				else
				{
					//Tout va bien, crée la table et ajoute le retour de la fonction au $message
					$message .= __LINE__ . " " . $database->create_table($nom_de_la_table);
					$message .= "<br>";
					
					//Enregistre la date du jour au format jj/m/aaaa
					$date_du_jour  = date("j/n/Y");
					
					//Insère une première entrée dans le blog
					$post = array("date"=>$date_du_jour, "author" =>'', "title" => 'Succès', "text" => 'Voici votre première page. Vous pouvez la modifier !', "category" => 'news', "category_new" => '', "operation" => "creation");
					$creation = $database->update_news($post, $nom_de_la_table);
					if($creation === false)
						//Crée un message d'erreur parce que l'enregistrement a échoué
						$message .= " <span style=\"color: red\">Crétion d'une entrée dans la table échouée...</span>";
				}
			}
			else
			{
				$message .= __LINE__ . " Message de création :<br>";
				$message .= __LINE__ . " Aucun nom n'a été renseigné pour cette table.<br>";
				$message .= __LINE__ . " Le nom est vide.<br>";
				$message .= __LINE__ . " <span style=\"color: red\">Le nom de la table est vide.</span><br>";
			}
		}
		
		/* Section optionnelle de suppression de table 
		//Supprime une table si demandé
		if($_POST['operation'] == "suppression")
		{
			if(isset($_POST['nom_de_la_table']) && null !== $_POST['nom_de_la_table'] && !empty($_POST['nom_de_la_table']))
			{
				$nom_de_la_table = $_POST['nom_de_la_table'];
				$message .= __LINE__ . " Message de suppression :<br>";
				$message .= __LINE__ . " Le nom de la table est renseigné.<br>";
				$message .= __LINE__ . " Nom de la table : \"" . $_POST['nom_de_la_table']."\"<br>";
				$message .= __LINE__ . " Opération: \"" . $_POST['operation'] . "\"<br>";

				//Supprime la table et ajoute le retour de la fonction au $message
				$message .= __LINE__ . " " . $database->drop_table($nom_de_la_table);
				$message .= "<br>";
			}
			else
			{
				$message .= __LINE__ . " Aucun nom n'a été renseigné pour cette table.<br>";
				$message .= __LINE__ . " Le nom est vide.<br>";
				$message .= __LINE__ . " \$nom_de_la_table est vide";
			}
		}
		*/
	}
?>