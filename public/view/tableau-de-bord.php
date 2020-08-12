<header>
	<h2>Tableau de bord</h2>
</header>

<article>
	<section class="col-lg-12">
		<fieldset class = "fieldset_profil">
		  
		  <legend>Nom: <?= $client->name();?></legend>
		  
		  <p>Vous êtes connecté.</p>
		  <?php
		  if(isset($client) && $client->level <= 5){
			?>
		    <a href="<?= $website->page_url;?>client-index">Modifier mon profil</a><br>
			<?php
		  }
		  ?>
		</fieldset>
	</section>
</article>