 
 
				README
				
Marc L. Harnist
Date: 2020/05/26

# Work in process
Testing router "client" : index.php?space=client&page=tableau-de-bord
Work repport: index.php?page=bac
Rooter client works well !
 - Now construc bricks or plugins with their own index, controller, view
	Example : contact page
	People do not always need a page contact (Stephane Chauvin, Bertrand Fruchet, SMC)
	If the client wants a contact page, install an AUTONOME contact page.
	Plugins are installed by the webmaster if the client has bought it. AND ONLY IF CLIENT WANTS IT !
	The website general rooter must check if plugins are here or not with index.php?space=plugin-name
	is_exists(plugin_page_contact.php)? require(plugin_page_contact/index.php(= controller) + view + model);
	brick/index.php = controller of the plugin.
CMS Test	Download compressed repertory : branch "dev" and test local & online


## Controll
 -ers / public, client, member
Création de trois espaces
 - public
 - clients
 - member
pour créer trois rooters

Class page
Add attribute "space" with setter ($GET['space']) and getter


## Idées d'évolution
Créer un rooter pour les controleurs: beaucoup de contrôleurs font la même chose !
- vérification des droits de l'utilisateur de lire ou d'écrire dans la page
- connexion à la base de donnée
Créer un rooteur: controllers/controller.php qui récupérerait dans l'url "espace"
Exemple: index.php?espace=membre pour l'adminstration
et       index.php?espace=client pour les clients
ensuite la page
index.php?espace=client&page=donnes pour la page des "données" de Mydataball par exemple ou index.php?espace=membre&page=admin-index pour les administrateurs ou les clients propriétaires du site qui y ont un droit d'accès. 
pour le reste:
index.php?espace=public&page=accueil par exemple
Il y a donc trois espaces pour l'instant: public, client et membre


#Last update
New controller bac but not enought strong to stop user under level 2. It's reserved to webmaster with right level = 1 but this page open with right level 2. It work for config-file-read.

File root/controller/page-from-page-index.php line 12: add a new line of code: the title of the new or other category, received from the database, is sent in the bloc html <head><title> with the method $page->setTitle($page_en_cours_de_lecture['title']);

Marc L. Harnist
Plan: Models
 - / View / Controllers en PHP et POO.
Particularité: index.php est le premier fichier lu par le navigateur.
Tous les fichiers du site (les modèles, les classes, les contrôleurs, l'en-tête du site, la vue, le pied de page) sont inclus dans le fichier index.php

## Idées d'évolution
### Création d’un nouvel objet : Client

La création d’un nouvel objet, “Client”, s’est avéré nécessaire pour éviter les confusions avec les autres niveaux des membres:
1 Webmaster - Il peut ajouter des membres - tout faire
2 Propriétaire - Il peut modifier les pages du blog!
3 Modérateur
4 Membre
5 Client

Créer un nouveau fichier Client.php dans root/classes pour créer de nouveaux objets “Client”.

Pouvoir se connecter avec l'email ou le nom
