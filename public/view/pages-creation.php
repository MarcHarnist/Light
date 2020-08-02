<article class="bg-light page-manager">

	<?=1>2?'<p class="m-1 text-white">Fichier: ' . __FILE__ .'</p>':''?>

	<header class="row bg-light">
		<h2 class="row m-3 text-muted">Créez vos propres pages!</h2>
	</header>
	<form class = "p-3 bg-secondary m-3 rounded" method="post" action="<?= $website->page_url;?>pages-save">
		<!--Form id deleted because 2 ids not valid html5 --> 
		<div class="row">
			<div class="col-lg-12">
				<h3><label for="titre" class="text-white">Titre</label></h3>
				<input  type="text" class="form-control" name="title" placeholder = "Choisissez le titre de votre nouvelle page" id="titre">
			</div>	
		</div>
		<div class="row pt-3">
			<div class="col-lg-3">
			  <h3><label for="date" class="text-white">Date</label></h3><input type="text" class="form-control" name="date" value="<?=isset($date_default)?$date_default:"Date? Controler found?"?>" id="date">
			</div>
			<div class="col-lg-3">
			  <h3><label for="author" class="text-white">Auteur</label></h3><input type="text" class="form-control" name="author" value="<?=WEBSITE_OWNER;?>" id="author">
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">
						<h3><label for="categorie" class="text-white">Catégorie</label></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<select class="form-control" name="category">
						  <option selected>Choisir une catégorie</option>
							<?php 
							foreach($categories as $categorie): ?>
								<option value="<?=$categorie;?>"><?=$categorie;?></option>
							<?php	
								endforeach; ?>
						</select>
					</div>
					<div class="col-lg-6">
						<input class="form-control w-100" type="text" name="category_new" placeholder="Créer une nouvelle catégorie">	
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-lg-2">
				<h3><label for="texte" class="text-white float-left mr-5">Votre texte</label></h3>
			</div>
			<div class="offset-lg-8 col-lg-2">
				<input class="form-control mb-1" type="submit" value="Enregistrer">
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<textarea class="form-control" rows="10" name="text" id="texte" placeholder="Pour insérer une image, un lien, changer le texte en gras, en petit, en plus grand: il vous faut d'abord enregistrer votre travail et charger l'image depuis la page d'édition des pages ou modifier votre texte grâce au bb-code de la page édition."></textarea>
				
				<input class="mt-1 form-control w-25" type="submit" value="Enregistrer">
				
				<input type="hidden" name="operation" value="creation"><br>
				<input type="hidden" name="last_id" value="<?=isset($last_id)?$last_id:""?>"><br>
			</div>
		</div>
	</form>
</article>