<?php

// File: www/model/ludacm/get_player.php

function get_member($offset, $limit)
{
    global $db;
    $offset = (int) $offset;
    $limit = (int) $limit;
        
    $req = $db->prepare('SELECT * FROM '.TABLE_MEMBER.' ORDER BY id LIMIT :offset, :limit'); // LIMIT will serve for 5 first easy players
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $member = $req->fetchAll();
    return $member;
	}