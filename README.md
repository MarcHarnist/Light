 
 
				README
				
				Marc L. Harnist
				26/05/2020
 
# Last release

## Plugin config-manager

I created an "engine / config-manager" plugin. This plugin presents a page with a form which proposes to change the identifiers of connection to the local database (localhost). So if you change these identifiers, the website will no longer work locally. Please don't laugh.

Seriously my idea today is to install a lite version of cms Light instead of config-manager and delete unused files.

This plugin will import the theme (CSS files, images, logo) of the website on which it is installed and will offer its pages, programs and services.

To figure out how to create a plugin, I have to imagine someone coming to your house and doing a repair: a plumber, a carpenter, a bricklayer. This person will scrupulously respect your interior, your decorations, your murals and will bring you some services, using the decorations of your house as is.

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

# Light
Marc L. Harnist
Plan: Models / View / Controllers en PHP et POO.
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
