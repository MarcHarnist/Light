<?php
	isset($category) ? '': exit("root/view/page-index Erreur: contrôleur absent?");//Vérifie que $category existe, sinon affiche un message d'erreur.
?>
<header>
	<h2>Index des pages de la catégorie "<?=$category;?>"</h2> 
</header>

<?=1==2?'<p class="m-1">Fichier: ' . __FILE__ .'</p>':''?>

<?php
// Display the N° (id), the title, the author and the date of the new choosen in a link to this new.
foreach($pages as $currentPage): ?>
	<article>
		<header>
			<h3 id="<?=$currentPage['id'];?>">
				<a href="index.php?page=page-from-pages-index
				&amp;id=<?=$currentPage['id'];?>
				&amp;titre=<?=$currentPage['url']?>" target="_blank">
				<?=$currentPage['title']?></a>
				
				<em>
				<small><small>
				<?php 
				if ($editor_display) include(PUBLIC_PATH.'/inc/menu-edition.php'); ?>
				<br />
				<?php if(BLOG_DATE_DISPLAY === "yes"): ?>
				Le <?=$currentPage['date'];?>
				<?php endif;?>
				
				<?php if(BLOG_AUTHOR_DISPLAY === "yes" && $currentPage['author'] != "") echo "Auteur: " . $currentPage['author'];?>
				</small></small>
				</em> 
			</h3>
		</header>
		<section>
			<?=$currentPage['text'];?>
		</section>
					<?php if($editor_display):?>
		<p class="icon"><?php include_once(PUBLIC_PATH.'/inc/menu-edition.php');?></p>
					<?php endif; ?>
	</article>
	<?php
endforeach;