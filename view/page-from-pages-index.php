<header>
	<h2><?=$page_en_cours_de_lecture['title']?></h2> 
</header>
<article>
	<!-- M.Harnist 07/03/2018 (created 02 octobre 2017 for the pages -->
	<p><?=$page_en_cours_de_lecture['text'];?></p>
	<p class="icon">
		<?php
		if (isset($editor) && $editor == True){
			// $editor == True? (see controller) 
			// The visitor has enough permissions, display the edition-link
			include_once("view/".'__menu-edition.php');
		}
		?>
	</p>
</article>
