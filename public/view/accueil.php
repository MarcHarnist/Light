<!--
									ACCUEIL
								   (Homepage)
	File : root/view/accueil.php
	Author : Marc Harnist
	Date : 2020-6-30
-->
	<?php
	  //Display here the error message from controller
	  if((isset($message) && Null !== $message && $message->getRed()) != "")
	  {
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	?>
	<article>
		<header>
			<h2><?=isset($currentPage['title'])?$currentPage['title']:"Bienvenue!"?></h2>
		</header>

		<?=isset($currentPage['text'])?$currentPage['text']:"";

		if(isset($editorMenuDisplay) && $editorMenuDisplay === True):?>
			<span class="icon"><?php include_once(PUBLIC_PATH.'/inc/menu-edition.php');?></span>
			<?php 
			endif;
		?>
	</article>
