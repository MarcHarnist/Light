<?php
	//Check if logo exists
	$file = "img/logo.png"; if(is_file($file)): ?>
	<a href="<?=$website->website_url;?>">
		<img
			class="" 
			src="<?=$file;?>" 
			alt="Logo, img/logo.png"
			height="60">
	</a>
<?php endif;?>