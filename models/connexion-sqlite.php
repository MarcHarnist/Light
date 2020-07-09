<?php
/**
*   Model
*                       
*   File : root/models/connexion-sqlite.php
*   "short" : only table with values. No list ol.
*   Author : Marc Harnist
*   Date : 2020-07-01
*   
*   Theme
*   Connection to Green It local material server
*/    

try {
    // Constants DB_HOST and other informed in config.php
    $db = new PDO('mysql:host=' . DB_HOST . ';
                dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->exec("SET CHARACTER SET utf8");
} catch(PDOException $e) {
    $DBerrorMessage = "Sorry there is a problem with the SQLite database connection :"; 
    echo $DBerrorMessage . $e->getMessage();
}
