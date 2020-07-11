<?php
/**          ROUTER CLIENT
*    
*    @File : root/client.php
*    @Author : Marc Harnist
*    @Date : 2020-07-10
*    Theme : Choose the right controller
*    
**/

//VARIABLES
  $repere = "( " . __FILE__ . " ligne " . __LINE__ . ")";

//Only members have rights to be here
if($client):
?>
<p>Router client<br>
<?=$repere?></p>
<?php endif; ?>