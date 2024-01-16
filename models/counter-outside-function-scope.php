<?php



$idCounter = 0;

function lambda (){
	
	global $idCounter;//Include var here
	$idCounter++;//$idCounter = 1. No passed in argument !
}