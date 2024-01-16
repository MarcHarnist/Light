<!--
                                 Controller config-file-read
									
	@File : root/controller/config-file-read.php (bac = bac à sable = sandbox)
	@Author : Marc L. Harnist
	@Date : 2020-07-01
	Theme : Try to display config file constants to edit them ;
    Use : model/config-file-reading.php. This model is automous with html, css and php code inside. 
    So it can be imported anywhere. 

-->
	<?php
	   //VARIABLES
		$model = "models/config-file-reading.php";//Required model
		$configFileToReadAndEdit = CONFIG_PATH;//Defined in public/config/config.php
		$rightLevelThisPage = 1;// 1 = only administrator
		$methods = new Methods;//Get and store a lot of usefull methods in the var. $methods
		$database = new Database; // Connect to database and upload usefull methods (sql requests)
		
		/* @var $message Type array used to display a message in case of false import or other operation */  
		$message["adminOnly"] = "Il faut être connecté en tant qu'administrateur du site web";

		//Action
		//Stop code and displays a message if user is not connect ad member or has not enought rights 
		isset($member)?$website->membersPermissions($rightLevelThisPage, $member):exit($message["adminOnly"]); 
    