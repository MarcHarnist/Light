<?php
/** Conroller "Page-save" = save pages updating in database
 *  @autor : Marc Laurent Harnist
 *  Creation : 2017/08/13
 *  Updating : 2020/08/10
 *  We arrive here from the file: root/public/admin/page-manager/page-update.php
 *  and from public/page-manager/page-creation.php (view)
 *  The values of the global $_POST are in the class 
 *  root/models/classes/DatabaseCreate treated
 *  This page reserved for level 1 & 2 users
 *  The users rights are checked in method setViewPath from class Page**/
$database = new Database;
$database->update_article($_POST);

if($database == True)
{
	//no error, we continue...
	header ('location: ' . $website->page_url . 'page-update&id=' . $database->N°);
	exit();
}

// else: form == False: there's an error: the view is load here by root/index.php...