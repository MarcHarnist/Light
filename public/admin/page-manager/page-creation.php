<style>
.page-manager p, p.page-edition {background-color:#6C757D!important;}
.page-manager h3 {background-color:#6C757D!important;}

article.page-manager { min-width:95% !important; margin: 0 auto !important;}
</style>
<article class="bg-light page-manager">

	<?=1>0?'<p class="m-1 text-white">Fichier: ' . __FILE__ .'</p>':''?>

	<header class="row bg-light">
		<h2 class="row m-3 text-muted">Créez vos propres pages!</h2>
	</header>
	<form class = "p-3 bg-secondary m-3 rounded" method="post" action="index.php?page=page-save">
		<!--Form id deleted because 2 ids not valid html5 --> 
		<div class="row">
			<div class="col-lg-12">
				<h3><label for="titre" class="text-white">Titre</label></h3>
				<input  type="text" class="form-control" name="title" placeholder = "Choisissez le titre de votre nouvelle page" id="titre" required>
			</div>	
		</div>
		<div class="row pt-3">
			<div class="col-lg-3 mt-1">
			  <h3><label for="date" class="text-white">Date</label></h3>
			  <input type="text" class="form-control mt-2" name="date" value="<?=isset($date_default)?$date_default:"Date? Controler found?"?>" id="date">
			</div>
			<div class="col-lg-3 mt-1">
			  <h3><label for="author" class="text-white">Auteur</label></h3>
			  <input type="text" class="form-control mt-2" name="author" value="<?=WEBSITE_OWNER;?>" id="author">
			</div>
			<div class="col-lg-6 mt-1">
				<div class="row">
					<div class="col-lg-12">
						<h3><label for="categorie" class="text-white">Catégorie</label></h3>
					</div>
				</div>
				<div class="row mt-1">
					<div class="col-lg-6 col-12">
						<select class="form-control" name="category">
						  <option selected>Choisir</option>
							<?php 
							foreach($categories as $categorie):
								if($categorie === "pages"):?>
									<option value="<?=$categorie;?>" selected><?=$categorie;?></option>
									<?php
								else:?>
									<option value="<?=$categorie;?>"><?=$categorie;?></option>
									<?php
								endif;	
							endforeach; ?>
						</select>
					</div>
					<div class="col-lg-6 col-12">
						<input class="form-control w-100" type="text" name="category_new" placeholder="Créer une catégorie">	
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-3 col-12">
				<input class="mt-1 form-control" type="submit" value="Enregistrer">
				
				<input type="hidden" name="operation" value="creation"><br>
				<input type="hidden" name="last_id" value="<?=isset($last_id)?$last_id:""?>"><br>
			</div>
		</div>
	</form>
</article>