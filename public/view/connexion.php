<header>
    <h2>Connexion à l'administration du site (privé)</h2>
</header>
<article>
  <section class="col-lg-12">
	<?php
	  if(isset($message) && ($message->getRed()) != ""){
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	?>
  </section>
  <section class="mt-1">
	<article>
		<form class="offset-lg-4 col-lg-4 text-center" method="post" action="#">
		  <div class="form-group">
			<label for="nom">
			  <input id="nom" class="form-control" type="text" name="name" <?php if(!isset($erreur_nom)) { ?> value = "<?=$save_nom?>" <?php }?> maxlength="50" placeholder = "Votre pseudo" required <?php if(empty($save_nom) or isset($erreur_nom)) echo "autofocus";?>>
			</label>
			<label for="pw">
			  <input id="pw" class = "form-control" type="password" name="password" maxlength="250" placeholder = "Mot de passe" required<?php if(isset($erreur_pw)) echo " autofocus";?>>
			</label>
		  </div>
			  <p class="text-center">
				  <input class = "btn lightColor text-white" type="submit"  name="utiliser" value="Se connecter"><br>
			  </p>
		</form>
	</article>

  </section>
</article>