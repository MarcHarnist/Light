<?php 
/**                                    Vue creer-compte
*                                       Marc L. Harnist
*                                            2017
*
*   Création d'un compte client indépendant et séparé des comptes "membres" de l'espace membre.
*/
?>
<header>
	<h2>Créer un compte</h2> 
</header>

<article>
	<?php
	//Affiche un message ici si un membre vient d'être créé
	if(isset($nouveau_client) && $nouveau_client != NULL)
	{
		?>
		<article>
			<h3 class="col-lg-12 ml-0 text-muted">Création du compte réussie</h3>

		<p><img style="margin-right:10px;height:30px; float:left;" src="img/smiley.png" alt="smiley au format png">
			<strong>Bienvenue <?=$nouveau_client->civilite() == 'Meur' ? ' monsieur ' : 'madame';?> <?=$nouveau_client->name();?></strong> ! <strong>Votre compte a bien été créé</strong>.<br>
			<?php
			//Si les droits = 5, c'est un client. Affiche un message de bienvenue spécial
			if($nouveau_client->level()===5)
			{
				?>
				
			<br>Nous sommes heureux de vous compter parmi nos clients !
		</p>
		
		<p>Vous pouvez vous connecter</p>
		
		</article>
		
		<article>
			<h3 class="col-lg-12 ml-0 text-muted text-center">Connexion</h3>
			<form class="offset-lg-4 col-lg-4 text-center" method="post" action="<?=$website->page_url;?>connexion-client">
			  <div class="form-group">
				<label for="nom">
				  <input 
				  id="nom" 
				  class="form-control" 
				  type="text" 
				  pattern="[a-zA-Z0-9]{,20}" 
				  name="name" 
				  <?php 
				  if(!isset($erreur_nom)) 
				  {
					  ?> 
				  value = "<?=$save_nom?>"
				  <?php 
				  }
				  ?> 
				  maxlength="50" 
				  placeholder = "Votre nom" 
                  required
				  <?php if(empty($save_nom) or isset($erreur_nom)) echo "autofocus";?>>
				</label>
				<label for="pw">
				  <input id="pw" class = "form-control" type="password" name="password" maxlength="250" placeholder = "Mot de passe" 
				required<?php if(isset($erreur_pw)) echo " autofocus";?>>
				</label>
			  </div>
				  <p class="text-center">
					  <input class = "btn lightColor text-white" type="submit"  name="utiliser" value="Se connecter"><br>
					  <a class="textLightColor" href="<?=$website->page_url;?>creer-compte">S'inscrire</a>
				  </p>
			</form>
		</article>
		<?php
		}
	}

	//Affiche un message d'erreur si l'inscription s'est mal passée
	elseif(isset($message) && $message->getRed() != Null)
	{
		echo $website::message("Petite erreur", $message->getRed(), "yellow");//yellow est la couleur de fond - background-color
		?>
		
		<p><a href="javascript:history.back()">Retour</a></p>
		
		<?php
	}
	//Page de création d'un compte
	else
	{
		?>
		  <form action="#" method="post">
			<div class="form-group row mt-1">
			  <label for="civilite" class="col-sm-2 col-form-label">Civilité</label>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Mme" required>
				  <label class="form-check-label" for="inlineRadio1">Madame</label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Meur">
				  <label class="form-check-label" for="inlineRadio2">Monsieur</label>
				</div>
			</div>
			<div class="form-group row mt-1">
			  <label for="name" class="col-sm-2 col-form-label">Nom</label>
				<div class="col-sm-10">
				  <input 
					type="text" 
					pattern="[a-zA-Z0-9]{,20}"
					maxlength="20"
					class="form-control" 
					id="name" 
					name="name" 
					placeholder="(Maximum 20 lettres et chiffres)"
					required>
				</div>
			</div>
			<div class="form-group row mt-1">
			  <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
			  <div class="col-sm-10">
				<input 
				type="text" 
				pattern="[a-zA-Z0-9]{,2}"
				maxlength="20"
				class="form-control" 
				id="firstname" 
				name="firstname" 
				placeholder="(Maximum 20 lettres et chiffres)"
				required>
			  </div>
			</div>
			<div class="form-group row mt-1">
			  <label for="email" class="col-sm-2 col-form-label">Email</label>
			  <div class="col-sm-10">
				<input 
				type="email" 
				class="form-control" 
				id="email" 
				name="email" 
				placeholder="Email"
				required>
			  </div>
			</div>
			<div class="form-group row mt-1">
			  <label for="pw" class="col-sm-2 col-form-label">Mot de passe</label>
			  <div class="col-sm-10">
				<input 
				type="password" 
				pattern=".{6,}" title="Au moins 6 caractères."
				maxlength="250" 
				class="form-control" 
				name="pw" 
				id="pw" 
				placeholder="Mot de passe"
				required>
			  </div>
			</div>
			<div class="form-group row mt-1">
			  <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
			  <div class="col-sm-10">
				<input type="tel" maxlength="250" class="form-control" name="phone" id="phone" placeholder="Téléphone"
				required>
			  </div>
			</div>
			 <!-- RGPD -->
			<div class="form-group mt-2">
				<div class="form-check">
					<label class="form-check-label" for="rgpd">
					  <input class="form-check-input" type="checkbox" id="rgpd"	required>
						* En soumettant ce formulaire, j’accepte que les informations personnelles fournies soient exploitées dans le cadre de ma demande et de la relation qui peut en découler.
					</label>
				</div>
			</div><!-- Fin RGPD -->
			
			<!-- Capcha -->
			<div class="form-group">
				<label for="capcha">Je ne suis pas un robot : </label>
				<?php 
					$capcha = rand(1,5);
					$capchaOk = $capcha+1;
				?>
				<p><?=$capcha;?> + 1 = <input class="rounded" id="capcha" name="capcha_reponse" size="3" required>
									   <input type="hidden" name="capcha" value="<?=$capchaOk;?>">
			</div><!-- Ferme capcha (<div class="form-group">) -->

			<!-- Niveau du membre : 5 par défaut = client -->
			<input class="form-check-input" type="hidden" name="level" value="5">
			
			<div class="form-group row mt-1">
			  <div class="col-sm-10">
				<button type="submit" class="btn lightColor text-white" name="creer" value="creation">Enregistrer</button>
			  </div>
			</div>
		  </form>
		<?php
	}
	?>
</article>