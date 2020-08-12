<?php
/** Controller user.php
*   Marc L. Harnist
*   2020-08-06
*
*   Rights are check in class Page.php / checkUserRightsForAdmin()
*/

	$count=1;
	$ancre=0;
	$database = new Database;
	$users = $database->read_table(TABLE_USERS);

