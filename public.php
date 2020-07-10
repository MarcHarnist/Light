<?php
/**          ROUTER PUBLIC
*    
*    @File : root/public.php
*    @Author : Marc Harnist
*    @Date : 2020-07-10
*    Theme : Choose the right controller
*    
**/

//VARIABLES
  $repere = "( " . __FILE__ . " ligne " . __LINE__ . ")";

//Only members have rights to be here
if($client)
?>
<i>Router public</i>
