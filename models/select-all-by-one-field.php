<?php

//Get all questions of one theme (example: "activité") from table "riasec_questions"
function selectAllFromTableNameWhereFieldValueInDatabase(string $table_name, string $field, string $value, Database $database)
{
	// The news are display from last to older
	$sql = 'SELECT * FROM ' . $table_name . ' WHERE ' . $field . ' = :value ORDER BY id ASC';
	
	$db = $database->getDb();
	
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':value' => $value));
	$selection = $sth->fetchAll();

    return $selection;
}
