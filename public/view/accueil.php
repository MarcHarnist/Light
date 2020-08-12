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

	<article
	<header>
	<h2>
	Light New Skeleton</h2>
	</header>

<p>	Nouvelle version de Light: Light New Skeleton.<br />
	Le dossier de configuration, les dossiers css, img, seront d&eacute;plac&eacute;s dans root/public</p>
	
<p>Autre article : <a href="index.php?page=page-from-pages-index&amp;id=132&amp;titre=en-savoir-plus-sur-light">En savoir plus sur Light...</a></p>
	</article>
	<?php
	
	/** CKEditor bug: the bug appears when you switch to see the code source
	*   in the page __page-creation.php. CKEditor add <p> </p> at each time
	*   you clic on the icone "source code". 
	*/
	//=$page_en_cours_de_lecture['text'];?>

	<?php
	// if($editor_display):
	?>
	<!--
	<span class="icon">
	<?php 
	//include_once('inc/menu-edtion.php');
	?>
	</span>
	-->
	<?php
	// endif; ?>
