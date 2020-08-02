<?php

try {
	// Constants DB_HOST and other informed in config.php
    $db = new PDO('mysql:host=' . DB_HOST . ';
				dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
    $DBerrorMessage = "Sorry there is a problem with the database connection :"; 
    echo $DBerrorMessage . $e->getMessage();
}
