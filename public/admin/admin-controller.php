<?php
/**       Contrôleur admin-controller.php
*              Marc L. Harnist
*
*  Date: 10/08/2018
*  Prepare the backoffice, the view public/admin/admin.php
*  Page reserved to the members with enought rights.
*
*  Rooter defined in classes/Page.php line 120 and following lines
*  Method : setViewPath() witch instanciate class Member
*  If member->level is to low, the user is redirected to 
*  the page root/view/acces-limite.php"; (limited access)
**/
if(isset($member)){
	
	$member_name = $member->name();
	$level       = $member->level();// member level int 1 = webmaster for example
}