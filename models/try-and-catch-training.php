<?php
//create function with an exception
function checkNum($number) 
{
  if($number>1) 
  {
    throw new Exception("La valeur doit être inférieure à 1: ) MLH");
  }
  return true;
}

try
{
	checkNum(2);
}
catch (Exception $e)
{
    $e->getMessage();
}
//trigger exception
/******************************************************
*   THE VIEW 
*/  
if(isset($e)) : 
?>
	<p><?=checkNum(-1)?></p>
	<p style="margin:50px;">Exception reçue dans le fichier <?= __FILE__ ?> à la ligne <?= __LINE__ ?> : <span style="color:red;"><?=  $e->getMessage() ?></span></p>
<?php
endif;
// ! UNCOMMENT NEXT LINE TO RUN THE Exception !    /////////
// echo $calcul;
