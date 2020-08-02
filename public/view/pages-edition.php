<!-- Affichage des pages à éditer dans la vue le 13/08/2017 ML-Harnist -->
<article class="bg-light page-manager">

	<?=1>2?'<p class="m-1 text-white">Fichier: ' . __FILE__ .'</p>':''?>

	<?php if($pages === False):?>
	<p class="messageRed">Page non trouvée. Id inconnu.</p>
	<?php
	endif; ?>

		<form class = "row p-3 bg-secondary m-3 rounded" method="post" action="index.php?page=pages-save">
			<div class="col-lg-12">
				<p class="text-white ">Modifiez vous-mêmes les pages de votre site! - <a  class="text-white" href="<?= $website->page_url . 'page-from-pages-index&id=' . $pages['id'] . '&categorie=' . $pages['category'] . '&titre=' . $pages['title'];?>">Voir la publication</a> - <a  class="text-white" href="<?= $website->page_url;?>pages-index&categorie=<?=$pages['category'];?>" title="Ouvrir la catégorie">Ouvrir la catégorie <?=$pages['category'];?></i></a> - <a  class="text-white" href="<?= $website->page_url;?>pages-creation">Nouvelle page</a> 
			</div>
			<div class="col-lg-12">
				<div class="row">
						<label for="titre" class="text-white col-lg-1">Titre:</label>
						<input class="form-control title h-25 w-100 col-lg-11" type="text" name="title" value="<?=$pages['title'];?>" id="titre">
				</div>
			</div>
			<div class="col-lg-12 pt-3">
				<div class="row h-25">
					<div class="col-lg-2">
						<div class="row">
							<label for="id" class="text-white d-inline col-lg-7" id="<?=$pages['id'];?>">Page n° </label>
							<input class="form-control d-inline w-100  h-25 col-lg-5" type="text" name="page_id" value="<?=$pages['id'];?>" id="id">
							<!-- on sauve la valeur de l'ancien N°-->
							<input type="hidden" name="N°" value="<?=$pages['id'];?>">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="row">
						<label for="date" class="text-white d-inline col-lg-7 text-right"> du (jj/mm/aaaa)</label>
							<input class="form-control d-inline h-25 col-lg-5" type="text" size="8" name="date" value="<?=$pages['date'];?>"  id="date"> 
					</div>
					</div>
						
					<div class="col-lg-3">
						<div class="row">
							<label for="author" class="text-white d-inline col-lg-4"> Auteur </label>
							<input class="form-control d-inline h-25 col-lg-8" type="text" name="author" value="<?=$pages['author'];?>" id="author">
						</div> 
					</div> 
						
					<div class="col-lg-3">
							<p class="text-white col-lg-12 h-25">Catégorie: <i>"<?=$pages['category'];?>"</i></p>
					</div> 
				</div> 
			</div> 
			
			<!-- Bloc des catégories: margin top 3 (mt-3) -->
			<div class="col-lg-12 pt-3">
				<div class="row">
					<div class="text-white col-lg-12">
					<div class="row">
						<p class="col-lg-3  text-white">Changer la catégorie:</p>		
						<select class="form-control col-lg-4 h-25" name="category">
						  <option selected><?=$pages['category'];?></option>
							<?php
								foreach($categories as $categorie){
								?>
								<option value="<?=$categorie;?>"><?=$categorie;?></option>
								<?php	
								}
								?>
						</select>
						<input class="col-lg-4 ml-3 form-control h-25" type="text" name="category_new" value="" placeholder="Créer nouvelle catégorie">	
					</div>
				</div>
			</div>
				<p class="col-lg-12 pt-3"> 
					<input class="form-control w-25"  type="submit" value="Enregistrer" />
				</p>
			<div class="col-lg-12 pt-3">
				<textarea class="form-control" rows="20" name="text" id="textarea"><?=$pages['text'];?></textarea>
				
				<input type="hidden" name="operation" value="update">
				
				<input class="form-control w-25 mt-3"  type="submit" value="Enregistrer">
			</div>
		</form>
</article>