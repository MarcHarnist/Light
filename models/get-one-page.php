<?php

$id = "1"; // default value
if(isset($_GET['id']) && !empty($_GET['id']))$id = htmlspecialchars($_GET['id']);
$req = $db->prepare('SELECT * FROM ' . TABLE_PAGES . ' WHERE id = ' . $id . '');
$req->execute();
$pages = $req->fetchAll();
return $pages;
