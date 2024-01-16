<?php
//Training: try with succes to add type to arguments: see "Database" below
//Get all questions of one theme (example: "activité") from table "riasec_questions"
function selectAllFromTableNameWhereTwoFieldsValueInDatabase(string $table_name, string $field, string $value, string $field_2, string $value_2, Database $database)
{
	// The news are display from last to older
	$sql = 'SELECT * FROM ' . $table_name . ' WHERE ' . $field . ' = :value AND ' . $field_2 . ' = :value_2 ORDER BY id ASC';
	
	$db = $database->getDb();
		
	$sth = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$sth->execute(array(':value' => $value, ':value_2' => $value_2));
	$selection = $sth->fetchAll();

    return $selection;
}
