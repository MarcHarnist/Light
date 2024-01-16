<article>
	<header class="row">
		<h2 class="col-lg-12 ml-0 mt-4 ">Config file read</h2>
	</header>
	<section class="col-lg-12 ">
		<h3 class="h5">
			<i>Lire et proposer une mise à jour du fichier de configuration de ce
				site web</i>
		</h3>
        <?php
        // Require model if exists, else, displays an error message
        is_file($model) ? require ($model) : print("<p>Erreur import modèle</p>");
        ?>
	</section>
</article>
