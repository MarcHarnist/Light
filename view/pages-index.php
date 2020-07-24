<?php
	isset($category) ? '': exit("root/view/page-index Erreur: contrôleur absent?");//Vérifie que $category existe, sinon affiche un message d'erreur.
?>
<header>
	<h2>Index des pages de la catégorie "<?=$category;?>"</h2> 
</header>

<?php
// Display the N° (id), the title, the author and the date of the new choosen in a link to this new.
foreach($pages as $page_en_cours_de_lecture)
{
	?>
	<article>
	<header>
		<h3 id="<?=$page_en_cours_de_lecture['id'];?>">
			<?php echo '<a href="' . $website->page_url . 'page-from-pages-index&amp;id='. $page_en_cours_de_lecture['id'] . '&amp;titre=' . $page_en_cours_de_lecture['url']. '" target="_blank">'.$page_en_cours_de_lecture['title'].'</a>';
			?>
			<em><small><small>
			<?php
			if (isset($member) && $member->level <= 2){
			
				// The user has enough permissions, display the edition-link
				// Le menu d'édition, de création de pages ou de suppression
				include("view/".'__menu-edition.php');
			}
			?>
			<br />
			Le <?=$page_en_cours_de_lecture['date'];?></em> <?php if($page_en_cours_de_lecture['author'] != "") echo "Auteur: " . $page_en_cours_de_lecture['author'];?></small></small>
		</h3>
	</header>
	
	<section><?=$page_en_cours_de_lecture['text'];?></section>

		<?php if (isset($editor) && $editor == True): //User has enough permissions ?>
			<p class="icon">
			<?php include_once("view/".'__menu-edition.php');?>
		<?php endif; ?>
	</p>
	
	
	
	</article>
	<?php
}