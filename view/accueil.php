<!--
									ACCUEIL
								   (Homepage)
	File : root/view/accueil.php
	Author : Marc Harnist
	Date : 2020-6-30
-->
	<?php
	  //Si la connexion se passe mal, un message s'affiche ici
	  if((isset($message) && Null !== $message && $message->getRed()) != ""){
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	?>

	<?=$page_en_cours_de_lecture['text'];?>

	<?php if($editor_display):?>

	<span class="icon"><?php include_once('inc/menu-edtion.php');?></span>

	<?php endif; ?>
