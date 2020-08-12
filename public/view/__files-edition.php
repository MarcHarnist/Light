<!-- Affichage des pages à éditer dans la vue le 13/08/2017 ML-Harnist -->
<article class="bg-light w-100 page-manager">
	<header class="row bg-light">
		<h2 class="row m-3 text-muted">Edition du fichier brut "<?=isset($fileName)?$fileName:"<i>(non renseigné)</i>"?>"</h2>
	</header>	

	<h3 class="h4">
		<!--<a href="<?//== $website->page_url;?>__sql">Sauvegarder les données avant d'éditer.</a> - -->
		<a href="<?= $website->page_url;?>" target="_blank">Voir le site</a> - <a href="<?= $website->page_url;?>__explorer">Explorateur de fichier</a> 
		
	</h3>
		<form class = "row p-3 bg-secondary m-3 rounded" method="post" action="<?= $website->page_url;?>__files-save">
		
		<div class="col-lg-12 pt-3">
				<p class="text-white">Nom du fichier : <?=isset($fileName)?$fileName:"<i>(Non renseigné)</i>"?></p>
				<label for="titre" class="text-white">Chemin :
					<input class="form-control title" type="text" size="76" name="title" value="<?=$getFile;?>" id="titre">
				</label>
			</div>
			
			<!-- Bloc des catégories: margin top 3 (mt-3) -->
			<div class="col-lg-12 pt-3">
				<div class="row">
					<p class="text-white col-lg-12">Dossier contenant ce fichier: <i>""</i></p>
					<div class="text-white col-lg-12">
					<div class="row">
						<p class="col-lg-5">Déplacer le fichier dans une autre dossier:</p>		
						<select class="form-control col-lg-6" name="repertory">
						  <option selected><?="";?></option>
							<?php
								// foreach($categories as $categorie){
								?>
								<option value="<?="";?>"><?="";?></option>
								<?php	
								// }
								?>
						</select>
					</div>
					</div>
					<div class="col pt-3">
						<input class="form-control w-100" type="text" name="category_new" value="" placeholder="Créer repertoire">	
					</div>
				</div>
			</div>
			
			<p class="col-lg-12 pt-3"> 
				<input class="form-control w-25"  type="submit" value="Enregistrer" />
			</p>
			
			
			<div class="col-lg-12 pt-3">
				<textarea class="form-control" rows="20" name="text" id="textarea"><?php foreach($fichier_en_cours_de_lecture as $line)echo $line;?></textarea>
				
				<input type="hidden" name="operation" value="update">
				<input class="form-control w-25 mt-3"  type="submit" value="Enregistrer">
			</div>
		</form>
</article>