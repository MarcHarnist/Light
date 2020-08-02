<header>
	<h2><?=$currentPage['title']?></h2> 
</header>
<article>
	<!-- M.Harnist 07/03/2018 (created 02 octobre 2017 for the pages -->
	<p><?=$currentPage['text'];?></p>
	<p class="icon">
		<?php
		if (isset($editor) && $editor == True){
			// $editor == True? (see controller) 
			// The visitor has enough permissions, display the edition-link
			include_once(PUBLIC_PATH.'/inc/menu-edition.php');
		}
		?>
	</p>
</article>
