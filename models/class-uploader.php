<?php

// This file is required in www.index.php

// Function upload OOP classes if an object is created
function class_upload($classname) { require 'classes/' . $classname.'.php';}
spl_autoload_register('class_upload');
