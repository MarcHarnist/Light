<?php
/**       Contrôleur tableau-de-bord.php
*              Marc L. Harnist
*
*  Date: 28/05/2020
*  Tableau de bord du client
*
*   Les différents niveaux
*   1 Webmaster - Il peut ajouter des membres - tout faire
*   2 Propriétaire - Il peut modifier les pages du blog!
*   3 Modérateur
*   4 Membre
*   5 Client
*
*
* $website: classe qui détaille les caractéristiques du site web.
  Si le client ($client) a un niveau > 5, la fonction clientsPermissions() va rediriger l'utilisateur vers la page "acces-limite" qui affiche: 
	Droits
	Page réservée
	Désolé, vous n'avez-pas les droits nécéssaires pour lire cette page. Contactez le webmaster pour demander plus de droits d'accès. */
	
//Si la variable $client n'est pas null on vérifie ses droits pour afficher la page sinon on redirige à la page "acces-limité"
$client !== Null?$website->clientsPermissions(5, $client):header('Location: ' . $website->redirection('acces-limite'));// Niveau 5 = client.
