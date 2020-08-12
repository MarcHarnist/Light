 
<a href="<?= $website->page_url;?>page-update&amp;id=<?=$currentPage['id'];?>" title="Modifier cette page">
	<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
</a>
<a href="<?= $website->page_url;?>page-creation" title="Créer une nouvelle page">
	<i class="fa fa-file-o" aria-hidden="true"></i>
</a>
<a href="index.php?page=page-delete&amp;id=<?=$currentPage['id'];?>" title="Supprimer cette page">
	<i class="fa fa-trash-o" aria-hidden="true"></i>
</a>
