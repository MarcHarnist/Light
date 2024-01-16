<?php
/****                 - Controller __explorer.php -
*                        	Marc L. Harnist
*                              25/03/2018
*	MAJ: 31/07/2018
*	Controller & view: __explorer.php
*	Classes: Explorer, Files
*   Particularité: instancie la classe Explorer qui parcourt les répertoires
*   et les fichiers pour les renvoyer dans un tableau (array()) qui sera 
*   affiché dans la vue.
*  
*   Permissions: page réservée aux niveaux 1 et 2
*/  $website->membersPermissions(2, $member);


$repertoire_a_explorer = "inc";
if(isset($_POST['other_dir']))//si on a changé le nom du répertoire par défaut
  $repertoire_a_explorer = $_POST['other_dir'];
$explorer = new Explorer($repertoire_a_explorer);
$navigateur = $explorer->navigateur($repertoire_a_explorer);
$explorateur = $explorer->explorateur($repertoire_a_explorer);