<?php
/**  Menu of catégories for the footer
*    Path: root/public/inc/categories.php
*    $categorie = array() that content all categories from mysql table "light_pages"
*/
if(isset($database))
{
	$categories = $database->list_categories();?>
	<hr>
	<p class="m-2">
		<i>Catégories :
			<?php 
			for($i=0; $i < count($categories); $i++)
			{
				if(isset($categories[$i])):
					?>
					<a href="index.php?page=pages-index&categorie=<?=$categories[$i];?>">
						<?=ucfirst($categories[$i]);?>
					</a>, 
					<?php
				endif;
			}
			//Exit the loop to replace the coma by a point for the last entry.
			if(isset($categories[$i])):
				?>
				 <a href="<?= $website->page_url;?>pages-index&categorie=<?=$categories[$i];?>"><?=ucfirst($categories[$i]);?></a>. 
				<?php
			endif;?>
		</i>
	</p>
	<?php
	}