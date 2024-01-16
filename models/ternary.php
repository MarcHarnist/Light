<?php
/**  Model "ternary.php"
*    @Author : Marc L. Harnist
*    @Date : 2020-07-03
*
*/  
//VARIABLES
$firstName = "Marc";
$name = "";

echo "Firstname: "; isset($firstName) AND print($firstName);//Un seul cas: true (AND)
echo "<br>Pseudo: "; isset($pseudo) AND print($pseudo);//Un seul cas: true (AND)
echo "<br>Pseudo: "; isset($pseudo)?print($pseudo):print("\$pseudo n'existe pas.");//True ou (:) false
?>