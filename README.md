
				README

 @author : Marc Harnist
 @date : 2023-11-04

# Branch devOps (devOps training by Suptg Niort CCi & Estia School)
 - To run Light on localhost, you need phpmyadmin (see above "Run the application in localhost);
 - To run online, you need to update the file public/config/config-online_s (see above "Online database connection : Rename file config-online_s in config-online");
 - To run the application, you need to run php server (see above "Run the application in localhost);


## 2023 Project for Light CMS
 - Clone the repository "Light" from https://github.com/MarcHarnist/light/tree/devOps;
 - Run the CMS on a web navigator;
 - Watch what happens;
 - Show the error displayed;
 - Propose a database creation formular;
 - Propose the database tables creation.

### First issue
 - "ERR_CONNECTION_REFUSED", Ce site est inacessible, localhost n'autorise pas la connexion";
 - The website does not run: PHP server must be started;

#### Ideas to first issue
 - Best idea in the moment: write a dashboard showing all actuals project and propose to run the servers php and sql;
 - Write an html code in "root/index.php": "do you want to start the PHP server?";
 - Write a Javascript code: popup window that opens if php server does not run;
 - Copy the best answer for the sql server.

##### Actions !
 - Creating a dashboard for des php and phpmyadmin server (example: Easyphp dashboard)
 - Creating a new repertory root/localhost, with index.html and "Start" button for the servers.

### Other ideas
 - create a plugin "install" like Wordpress but much simple;


## Online database connection : Rename file config-online_s in config-online
Write you own database ids and password in public/config/config-online.php.
This file is in gitignore list...

## Run the application in localhost
 - Clone the repository "Light" from https://github.com/MarcHarnist/light/tree/devOps;
 - Install phpmyadmin: download the phpmyadmon files from the web;
 - Paste the files in the same repertory of your project;
 - Use "make": open the Light/makefile and see the options;
 - To run the phpmyadmin server, write "make serv" in the Win. command prompt (CMD);
 - To run the web application Light, write "make light" in the command prompt;
 - If you "make option" is on the top list, you can only write "make" in the command prompt, and "enter";

## How to create a page in the view

### Example: homepage

Name : accueil.php
Path : controller/accueil.php and public/view/accueil.php

## Git practices
 - commits comment are crucials !

### Rallback to a latest commit is really exciting !

#### Commands lines:
1. git add .
2. git commit -m "README.md update"
3. git push (Push only the branch)
4. git push --set-upstream (Push all)

git log //to see all commits number (hash)
//memorize or copy a commit number (hash)

git checkout [number]
//you can create a new branch

git branch -c rall-back-test
//or not; You can use the command : git log oneline.
And then you see that the comments are very important to detect wich version you want to restore!

git push --set-upstream
//Send the projects on Git browser (Github for example)


# Light
Marc L. Harnist
Plan: Models / View / Controllers en PHP et POO.
Special feature: index.php is the first file read by the browser.
All site files (templates, classes, controllers, site header, view, footer) are included in the index.php file

## Light is able to find each file installed anywher in the application !

1. Create a repertory root/test/;
2. Example : root/charlie;
3. Create a file inside : root/charlie/test.php;
4. Optionnal : Create a controller : root/charlie/test-controller.php
5. Open navigator in url : light/index.php?page=test;
6. The browser will find Charlie?

## Tout fichier créé dans /admin/ déclenche la demande de connexion
Si l'on déplace un fichier dans le répertoire admin, l'ouverture de la page de connexion est déclenchée !

## Trois espaces : publique, et privés: clients et membres.
Il y a trois espaces pour l'instant: public, client et membre.

## The web application configuration file (Config.php) is editable online
I create a new file that is abble to open, read and display the web application configuration file in an html page, by copying an other model created this month.
This configuration file, specific to each application, is stored in the repertory "public".

### Objective make the CMS upgradings easy by separating data and codes
root / engine / models / is the path where all models will be stored.

It will be easy to upgrade the website engine in a new version, just in upload the repertory "engine" and not touch the repertory "public". So, the web application design, images, and all its specific files wont be destroyed.

### Last creation with Light CMS : Riasec