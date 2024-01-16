<h1>
	<?php 
	//Require logo.php if exists and if config file says yes for displaying
	$file = PUBLIC_PATH."/inc/logo.php";
	if(is_file($file))
	{
		if(LOGO_DISPLAY === "yes")
		{
			echo "<!-- Config/logo_display = yes. -->\n";
			require_once($file);
		}
		else
		{
			echo "<!-- Config/logo_display = no. -->";
		}
	}
	?>
	
	<!-- WEBSITE TITLE -->
	<a href="<?=$website->website_url;?>"><?=WEBSITE_NAME?></a>
</h1>	
<!-- WEBSITE SUBTITLE -->
<div class="col-12 col-lg-12"><span class="subtitle"><?=SUBTITLE?></span></div>
