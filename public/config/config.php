<?php
/**  CONFIG FILE
*    File : root/config/config.php
*    Author : Marc Harnist
*    Date de création : 2020-07-01
*    Date mise à jour : 2022-01-12
*    Content : website constants
**/

define('DOMAIN', 'light');//com
define('WEBSITE_NAME', 'Light');//
define('SUBTITLE', 'Un CMS utilisant peu de ressources !');//
define('SUBTITLE_DISPLAY', 'yes');//
define('WEBSITE_URL', 'index.php');//Website url
define('PAGE_URL', 'index.php?page=');//pages url used in root/inc/header.php
define('LOGO_DISPLAY', 'yes');//
define('MENU_DISPLAY', 'yes');//
define('BLOG_AUTHOR_DISPLAY', 'no');//
define('BLOG_DATE_DISPLAY', 'no');//
define('TITLE_DISPLAY', 'yes');//
define('ANIMATION_DISPLAY', 'no');//
define('MENU_FOOTER_DISPLAY', 'yes');//
define('PLUGINS_PATH', 'engine');///pages url used in root/inc/header.php
define('PUBLIC_PATH', 'public');///pages url used in root/inc/header.php
define('CONFIG_PATH', 'public/config/config.php');//used in controller/config-file-read
define('BACKUPS_PATH', 'public/backups');//used in class Sql
define('WEBMASTER', 'Marc Harnist');//Webmaster name used in classes/Database
define('WEBSITE_OWNER', 'Marc Harnist');//
define('OWNER_MAIL', 'contact@marcharnist.fr');//
define('GITHUB_REPOSITORY', 'https://github.com/MarcHarnist/light/tree/devOps');//
define('KLINY_MANALA', 'https://drklinymanala.fr');//
define('USE_LOCAL_SERVER', 'NO');//
define('DB_NAME', 'marcharnssmarc');//Constants 2020-06-30
define('DB_CHARSET', 'utf8');//DB charset to use in database mysql in table creation
define('TABLE_CLIENT', 'light_clients');//
define('TABLE_MEMBER', 'light_members');//
define('TABLE_PAGES', 'light_pages');//
define('TABLE_STATS', 'light_stats');//
define('MAX_SIZE', '10000000');//Taille max en octets du fichier classe Website
define('WIDTH_MAX', '3000');//Largeur max de limage en pixels classe Website
define('HEIGHT_MAX', '2000');//Hauteur max de limage en pixels
define('LEVEL', '100');//Niveau par défaut des utilisateurs classe Website
