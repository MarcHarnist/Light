<?php
/**          Catégories           **
*    2019-02-20 Marc Harnist.
*    Mis à jour : 2020-06-18
*    Menu des catégories pour le pied de page
*    inc/categories.php
*/

/** New object "categorie" created now which content all pages and all categories
*   from mysql/table "pages"
*/
	if(isset($read))
	{
		$categories = $read->list_categories();
	?>

	<hr>

	<p class="m-2">
		<i>Catégories :
			<?php 
			for($i=0; $i < count($categories)-1; $i++){
				?>
				 <a href="<?= $website->page_url;?>pages-index&categorie=<?=$categories[$i];?>"><?=ucfirst($categories[$i]);?></a>, 
				<?php
			}
			//Sort de la boucle pour le dernier lien pour ajouter un point et non une virgule !
			?>
			 <a href="<?= $website->page_url;?>pages-index&categorie=<?=$categories[$i];?>"><?=ucfirst($categories[$i]);?></a>. 
		</i>
	</p>
	<?php
	}
	?>
