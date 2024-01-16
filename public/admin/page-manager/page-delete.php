	<?=1>0?'<q class="m-1 p-1 text-secondary"><i>Fichier ' . __FILE__ .'</i></q>':''?>

<!-- Delete one page, choosen in pages-index or in page-from-pages-index
									M.Harnist 02 octobre 2017 -->

<h3 class="text-danger">Etes-vous sur de vouloir supprimer l'article ci-dessous:</h3>
<h4 class="text-danger">Attention ! Cette suppression sera définitive.</h4>

<div class="m-2 p-2 border border-primary rounded">
	<h3>
		N° <?=$currentPage['id']?> - <?=$currentPage['title']?><br />
		<em>Le <?=$currentPage['date'];?></em><br>
	</h3>
	<h4 class="text-primary">
		Catégorie:  <?=$currentPage['category'];?>
	</h4>
		
	<p><?=$currentPage['text'];?></p>
</div>

<div class="row">
	<form class="col-lg-2" method="post" action="">
		<p>
			<input type="hidden" name="id" value="<?= $currentPage['id'];?>" />
			<input class="btn btn-danger text-white" type="submit" value="Confirmer la suppression" />
		</p>
	</form>
	 <form class="col-lg-8" method="post" action="<?= $website->page_url . 'pages-index&categorie=' . $currentPage['category'];?>">
		<p>
			<input type="hidden" name="id" value="<?= $id;?>" />
			<input class="btn btn-success rounded text-white" type="submit" value="Annuler" />
		</p>
	</form>
</div>