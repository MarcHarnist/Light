 
				README
				
Marc L. Harnist
Creation: 2020/05/26
Updated : 2020/07/13

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
### Create rooter in index.php in each plugin
Créer un rooter dans index.php de chaque plugin pour les controleurs: beaucoup de contrôleurs font la même chose !
- vérification des droits de l'utilisateur de lire ou d'écrire dans la page
- connexion à la base de donnée
Exemple: index.php?espace=membre pour l'adminstration
et       index.php?espace=client pour les clients
ensuite la page
index.php?espace=client&page=donnes pour la page des "données" de Mydataball par exemple ou
index.php?espace=membre&page=admin-index pour les administrateurs ou les clients propriétaires du site qui y ont un droit d'accès. 
pour le reste:
index.php?espace=public&page=accueil par exemple
Il y a donc trois espaces pour l'instant: public, client et membre

Light à télécharger de Github comme Wordpress et install 10mn: index.php?page=instal !
 - OOP : avantage = encapsulation. Change public attributes to private in Light and add setters and getters
 - Edit config/ webmaster mail: contact@marcharnist.fr !
 - classe/Database change attributs to private, create setters and getters
 - .ini file : use php native function "getElementByTagName() put_element by tag name() "
 - light/__page-creation and __page-edition are ugly ! Restore css !
 - Light = peu de fichiers et ressoures, sobriété numérique = écolo
 - Light: controllers en php, models SQL, view HTML
 - Mail pro = contact@marcharnist.fr
 - Mail private = harnist.marc@gmail.fr

#Last update
New controller bac but not enought strong to stop user under level 2. It's reserved to webmaster with right level = 1 but this page open with right level 2. It work for config-file-read.

File root/controller/page-from-page-index.php line 12: add a new line of code: the title of the new or other category, received from the database, is sent in the bloc html <head><title> with the method $page->setTitle($page_en_cours_de_lecture['title']);

Marc L. Harnist
Plan: Models
 - / View / Controllers en PHP et POO.
Particularité: index.php est le premier fichier lu par le navigateur.
Tous les fichiers du site (les modèles, les classes, les contrôleurs, l'en-tête du site, la vue, le pied de page) sont inclus dans le fichier index.php

