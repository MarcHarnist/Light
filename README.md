 
 
				README
				 
 
 @author : Marc Harnist
 @date : 2020-07-17 
 Branch dev-engin-config-manager

# Last release

Try to repare ckEditor
 * idea: I mean that only page light/index.php?page=pages-index&categorie=news display to much space between lines?
 * this page works well : 
 index.php?page=page-from-pages-index&id=131&categorie=pages&titre=Mentions-légales

# News
Hello world !
I am working on root / engine / models /
I create a new file that is abble to open, read and display the web application configuration file in an html page, by copying an other model created this month. This configuration file, specific to each application, is stored in the repertory "public". So, it will be easy to upgrade the website engine in a new version, just in upload the repertory "engine" and not touch the repertory "public". So, the web application design, images, and all its specific files wont be destroyed.

# What I learned today !

## Versioning : commits comment are crucials !

I learned how rallback to a latest commit. It is really exciting ! 
Commands lines:

git log //to see all commits number (hash)
//memorize or copy a commit number (hash)

git checkout [number]
//you can create a new branch

git branch -c rall-back-test
//or not; You can use the command : git log oneline.

And then you see that the comments are very important to detect wich version you want to restore!

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
