<?php
	//Check if logo exists
	$logoPath = PUBLIC_PATH."/img/logo.png";
	if(is_file($file)): ?>
	<a href="<?=$website->website_url;?>">
		<img
			class="" 
			src="<?=$logoPath;?>" 
			alt="Logo, "<?=$logoPath?>
			height="60">
	</a>
<?php
endif;?>