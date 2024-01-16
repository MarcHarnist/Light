<?php
if(isset($categories))
{
	foreach($categories as $categorie){
		switch($categorie)
		{
			case "test":
			continue 2;
		}
		?>
		<li class="nav-item"><!-- MEMBER SPACE DECONNECTION BUTTON -->
			<a class="mr-2" href="<?= $website->page_url;?>pages-index&categorie=<?=$categorie;?>"><?=ucfirst($categorie);?></a>
		</li>
		<?php
	}
}
