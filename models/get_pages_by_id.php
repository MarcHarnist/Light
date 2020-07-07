<?php
function get_pages($offset, $limit)
{
    global $db;
    $offset = (int) $offset;
    $limit = (int) $limit;
        
    $req = $db->prepare('SELECT * FROM ' . TABLE_PAGES . ' ORDER BY id DESC LIMIT :offset, :limit');
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $pages = $req->fetchAll();
    
    
    return $pages;
}