<?php

/* Index of engine/config-manager plugin */

$pluginPath = PLUGINS_PATH . "/config-manager";
$controlerPath = $pluginPath . "/config-localhost-file-read-controller.php";
$viewPath = $pluginPath . "/config-localhost-file-read-view.php";
$headerPath = $pluginPath . "/header.php";
$footerPath = $pluginPath . "/footer.php";


//CONTROLERS
//Import controler if exists for this page name or exit an display an error message
file_exists($controlerPath)? include_once $controlerPath:exit($controlerPath.' existe ???');

//VIEW
//Import header, view and footer if exist or displays error message. (Can import menu.php, categories.php...)
file_exists($headerPath)?require_once($headerPath): exit($headerPath.' 1 existe ?');
file_exists($viewPath)?require($viewPath): exit($viewPath.' 2 existe ?');
file_exists($footerPath)?require($footerPath): exit($footerPath.' 3 existe ?');


				// store member in session var to economyse a SQL request.
				if(isset($member)){
					$_SESSION['member'] = $member;
					
					var_dump($member);
					
					if(is_object($member)) {
						$member = $member->name();
						$_SESSION['member'] = $member;
					}
				}//close if(isset($member))	// store member in session var to economyse a SQL request.
