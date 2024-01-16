<header>
    <h2>Utilisateurs</h2>
</header>   
<article>
    <div class="col-lg-12 col-sm-12">
	<?php
	if(isset($users)):
		foreach($users as $key => $user):?>
			<form class="my-3" method="post" action="index.php?page=user-update">
				<div class="form-group row">
					<label for="id" class="col-sm-2 col-form-label">ID</label>
					<div class="col-sm-10">
						<input 
						type="text" 
						class="form-control" 
						id="firstname" 
						name="new_id"
						id="id"
						placeholder="id" 
						value="<?=$user['id']?>"
						required>
					</div>
				</div>
				<div class="form-group row">
					<label for="civilite" class="col-sm-2 col-form-label">Civilité</label>
						<div class="form-check form-check-inline ml-3">
							<input class="form-check-input" type="radio" name="civilite" id="inlineRadio1"
							   value="Mme" <?php if($user['civilite'] == 'Mme') echo 'checked ';?> required>
							<label class="form-check-label" for="inlineRadio1">Madame</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="civilite" id="inlineRadio2"
							   value="Meur" <?php if($user['civilite'] == 'Meur') echo 'checked ';?> >
							<label class="form-check-label" for="inlineRadio2">Monsieur</label>
						</div>
				</div>
				<div class="form-group row">
					<label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
					<div class="col-sm-10">
						<input 
						type="text" 
						class="form-control" 
						id="firstname" 
						name="firstname" 
						placeholder="Prénom" 
						value="<?=$user['firstname']?>"
						required>
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label">Nom</label>
					<div class="col-sm-10">
						<input 
						  type="text" 
						  class="form-control" 
						  id="name" 
						  name="name" 
						  placeholder="Nom"
						  value="<?=$user['name'];?>"
						  required>
					</div>
				</div>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input 
						type="email" 
						class="form-control" 
						id="email" 
						name="email" 
						placeholder="Email"
						value="<?=$user['email']?>"
						required>
					</div>
				</div>
				
				<!-- Données conservées telles qu'elles 
				<input type="hidden" name="id" value="<?=$user['id']?>">
				<input type="hidden" name="new_id" value="<?=$user['id']?>">

				<div class="form-group row">
					<div class="col-sm-10">
						<input type="hidden" name="operation" value="update">
						<button type="submit" class="btn lightColor text-white">Enregistrer</button>
					</div>
				</div>
				-->
			</form>
		<?php
		endforeach; 
	else:
	?>
	$users inconnu. Le contrôleur n'a pas dû être trouvé...
	<?php
	endif;
	?>
    </div>
</article>
