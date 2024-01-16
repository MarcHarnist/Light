<?php
/**       Contrôleur admin-controller.php
*              Marc L. Harnist
*
*  Creation 2020-08-07
*  Get the statistics values in db table "riasec_stats"
*  Page reserved to the members with enought rights : 2 (owner)
*  In repertory public/admin. Rooter defined in classes/Page.php
*  line 120 and following lines
*  Method : setViewPath() that instanciates the class Member
*  If member->level is to low, the user is redirected to 
*  the page root/view/acces-limite.php"; (limited access)
**/

//Connect to db and presents methods to CRUD
$database = new Database();
$stats = $database->read_table(TABLE_STATS);
