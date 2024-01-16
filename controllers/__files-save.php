<?php
/**                    files-save.php
*
*                      Marc L. Harnist
*
*   29-07-2018 (déjà créé dans les années 2000 mais abandonné)
*   Enregistrement des modifications d'un fichier ouvert en écriture
*   Nous arrivons ici depuis index-dynamic.php

*  This page reserved for level 1 & 2 users
*/ $website->membersPermissions(2, $member);

$file = new Files;
$file->file_update($_POST); // Update the file in class FilesUpdate
	header ('location: ' . $website->page_url . '__files-edition&file=' . $file->title);