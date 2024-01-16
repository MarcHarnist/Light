<?php

// This file is required in www.index.php

// Function upload OOP classes if an object is created

$classesPath = "classes/";
if(is_file($classesPath."Page.php") === False)
	$classesPath = "../../classes/";

function class_upload($classname) {
	global $classesPath;
	require $classesPath . $classname.'.php';}
spl_autoload_register('class_upload');

