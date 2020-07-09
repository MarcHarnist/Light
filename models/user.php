<?php

// This file is required in www.index.php
// Is a user connected? What are his permissions(level)?

$level = 10; // default value: no permissions

// Is a member connected?
if(isset($_SESSION['member'])) {

	$manager = new MembersManager($db); // New object with data base informations
	$name = $_SESSION['member'];
	$member = $manager->get($name);//not forget "get"! else: db do not update
	if($member == NULL){ // sometimes bugs arrive when member is erased but not the navigator memory
		unset($member); // The member do not exists in database but still in the navigator memory. We empty it.
		unset($_SESSION['member']); // same action to session memory
		session_destroy(); // close de session
	}else { // Member exists in database.
		$level = $member->level(); 
	}
}

