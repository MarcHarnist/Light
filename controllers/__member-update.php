<?php
/**             Contrôleur __member-update
*                   Marc L. Harnist
*                       28/08/2018
*
*   Autorisation limitée au webmaster
*/  $website->membersPermissions(1, $member);

  $update = new Database;
  $db_table = TABLE_MEMBER;//Base de données
  $ancre = $update->update_table_members($db_table, $_POST);
  header ('Location: ' . $website->page_url . '__member-index#' . $ancre . '');