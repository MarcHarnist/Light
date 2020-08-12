<!--
                                 Client-Update de Light
 
                                       MH Light
                                      22 V 2020
-->
<header>
    <h2>Modification du compte client</h2>
</header>
<article>
  <section class="col-lg-12">
	<?php
	  //Si la connexion se passe mal, un message s'affiche ici
	  if(($message->getRed()) != ""){
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	  if(($message->Green()) != ""){
		echo $website::message("Message", $message->Green(), "green");
	  }
	  
	?>
  </section>
  <section class="mt-1">
	<article>

		<h4><i>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</i></h4>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fermentum ex a mauris mollis, eu accumsan nunc fermentum. Vestibulum placerat ut arcu eget hendrerit. Duis fermentum commodo nunc id auctor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer justo nunc, luctus quis nulla in, accumsan ultricies nulla. Sed sapien ex, porta sed est et, varius mattis urna. Nulla luctus, mi at suscipit imperdiet, metus odio euismod ante, eu vulputate tellus ipsum ut neque. Nunc sagittis urna ut sapien dictum, in porta lorem bibendum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
		
	</article>
	<?php
	//Vérifie si un membre est connecté.
	if(isset($client) && $client != NULL)
	{
		//Si oui, affiche un message de bienvenue
		?>
		<p><img style="margin-right:10px;height:30px; float:left;" src="img/smiley.png" alt="smiley au format png">
			Bienvenue <strong><?=$client->civilite();?> <?=$client->name();?></strong> !
			<?php
			//Si les droits = 5, c'est un client. Affiche un message de bienvenue spécial
			if($client->level()===5)
			{
				?>
				
			<br>Nous sommes heureux de vous compter parmi nos clients !
				
				<?php
			}
	}
	else
	{
	//Formulaire de connexion
	?>
	<article>
		<h3 class="col-lg-12 ml-0 text-muted text-center">Connexion</h3>
		<form class="offset-lg-4 col-lg-4 text-center" method="post" action="<?=$website->page_url;?>connexion-client">
		  <div class="form-group">
			<label for="nom">
			  <input id="nom" class="form-control" type="text" name="name" <?php if(!isset($erreur_nom)) { ?> value = "<?=$save_nom?>" <?php }?> maxlength="50" placeholder = "Votre nom" required <?php if(empty($save_nom) or isset($erreur_nom)) echo "autofocus";?>>
			</label>
			<label for="pw">
			  <input id="pw" class = "form-control" type="password" name="password" maxlength="250" placeholder = "Mot de passe" required<?php if(isset($erreur_pw)) echo " autofocus";?>>
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
	?>
  </section>
</article>