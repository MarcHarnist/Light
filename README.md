 
 
				README
				 
 
 @author : Marc Harnist
 @date : 2020-07-17 
 
# News
Hello world !
I am working on root / engine / models /
I create a new file that is abble to open, read and display the web application configuration file in an html page, by copying an other model created this month. This configuration file, specific to each application, is stored in the repertory "public". So, it will be easy to upgrade the website engine in a new version, just in upload the repertory "engine" and not touch the repertory "public". So, the web application design, images, and all its specific files wont be destroyed.

Add a new line useless here to test git rallback

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
