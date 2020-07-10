<?php
/**          Contrôleur __client-index
*   Theme
*   Client liste updating by the webmaster or website owner only
*   Author:   Marc L. Harnist
*   Creation : 2018/08/28
*   Updating : 2020/07/10
*
*/ 
//Verify member permissions to be here
$website->membersPermissions(1, $member);

$ancre=0;//Anchor to com back at the right line
$count=1;//Give a number to the anchor

//DB connection
$database = new Database;

//Get all pages 
$datas = $database->read_table(TABLE_CLIENT);//TABLE_CLIENT: see config/config.php


