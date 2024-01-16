
<?php

function get_all_pages()
{
    global $db;
    $reponse = $db->prepare('SELECT * FROM ' . TABLE_PAGES . ' ORDER BY date DESC, id desc');
    $reponse->execute();
    $pages = $reponse->fetchAll();
    return $pages;
}