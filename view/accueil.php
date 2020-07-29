<!--
									ACCUEIL
								   (Homepage)
	File : root/view/accueil.php
	Author : Marc Harnist
	Date : 2020-6-30
-->
<header>
    <h2>Accueil</h2>
</header>
	<?php
	  //Si la connexion se passe mal, un message s'affiche ici
	  if((isset($message) && Null !== $message && $message->getRed()) != ""){
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	?>
<article>

	<?=$page_en_cours_de_lecture['text'];?>

	<?php if($editor_display):?>

	<p class="icon"><?php include_once("view/".'__menu-edition.php');?></p>

	<?php endif; ?>

</article>
