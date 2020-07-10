<?php
/**          ROUTER MEMBER
*    
*    @File : root/member.php
*    @Author : Marc Harnist
*    @Date : 2020-07-10
*    Theme : Choose the right controller
*    
**/

//VARIABLES
  $repere = "( " . __FILE__ . " ligne " . __LINE__ . ")";

//Only members have rights to be here
if($member)
 echo $member->getName();
echo $page->getSpaceName();