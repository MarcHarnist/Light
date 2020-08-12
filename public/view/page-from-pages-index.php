<header>
	<h2><?=isset($currentPage['title'])?$currentPage['title']:print("Erreur, pas de page courante.")?></h2> 
</header>
<article>
	<!-- M.Harnist 07/03/2018 (created 02 octobre 2017 for the pages -->
	<p><?=isset($currentPage['text'])?$currentPage['text']:print("Erreur, pas de page courante.");?></p>
	<p class="icon">
		<?php
		if (isset($editor) && $editor == True && isset($currentPage)){
			//$editor = True? (see controller) & user has enough permissions to see edition-links
			$fileMenuPageManager = PUBLIC_PATH.'/inc/menu-page-manager.php';
			is_file($fileMenuPageManager)?include_once($fileMenuPageManager):print("<i>Menu d'édition introuvable.</i>");
		}
		?>
	</p>
</article>
