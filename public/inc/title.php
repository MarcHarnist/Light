<h1>
	<!-- LOGO -->
	<?php 
	//Require logo.php if exists and if config file says yes for displaying
	$file = PUBLIC_PATH."/inc/logo.php"; if(is_file($file) && LOGO_DISPLAY === "yes") require_once($file); ?>
	
	<!-- WEBSITE TITLE -->
	<a href="<?=$website->website_url;?>"><?=WEBSITE_NAME?></a>
</h1>	
<!-- WEBSITE SUBTITLE -->
<div class="col-12 col-lg-12"><span class="subtitle"><?=SUBTITLE?></span></div>
