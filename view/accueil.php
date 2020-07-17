<!--
									ACCUEIL
								   (Homepage)
	File : root/view/accueil.php
	Author : Marc Harnist
	Date : 2020-6-30
-->
<header>
    <h2>Accueil</h2>
</header>
	<?php
	  //Si la connexion se passe mal, un message s'affiche ici
	  if((isset($message) && Null !== $message && $message->getRed()) != ""){
		echo $website::message("Petite erreur", $message->getRed(), "pink");
	  }
	?>
<?php
	//If a client is connected (is set), continue and displays welcome message
	if(isset($client) && $client != NULL)
	{
		?>
		<article class="mt-1">
			<p class="p-3"><img style="margin-right:10px;height:30px; float:left;" src="img/smiley.png" alt="smiley au format png">
			Bienvenue <strong><?=$client->civilite();?> <?=$client->name();?></strong> !
			<?php
			//Si les droits = 5, c'est un client. Affiche un message de bienvenue spécial
			if($client->level()===5)
			{
				?>
				
			<br>Nous sommes heureux de vous compter parmi nos clients !
		</article>
			<?php
		}
	}
	else
	{
		//Else, no client connected, display connection form
		?>
		<article class="pl-5">
			<header>
				<h3>Bienvenue !</h3>
			</header>
			
			<p>Vous pouvez vous connecter.</p>		
		
			<h3 class="col-lg-12 ml-0 text-center">Connexion</h3>
			
			<form class="offset-lg-4 col-lg-4 text-center" method="post" action="<?=$website->page_url;?>connexion-client">
			
			  <div class="form-group">
				<label for="nom">
				  <input id="nom" class="form-control" type="text" name="name" <?php if(!isset($erreur_nom) && isset($save_nom)) { ?> value = "<?=$save_nom?>" <?php }?> maxlength="50" placeholder = "Votre nom" required>
				</label>
				<label for="pw">
				  <input id="pw" class = "form-control" type="password" name="password" maxlength="250" placeholder = "Mot de passe" required<?php if(isset($erreur_pw)) echo " autofocus";?>>
				</label>
			  </div>
				  <p class="text-center">
					  <input class = "btn  text-white lightColor" type="submit"  name="utiliser" value="Se connecter"><br>
					  <a href="<?=$website->page_url;?>creer-compte">S'inscrire</a>
				  </p>
			</form>
		</article>
	<?php
	}
?>
