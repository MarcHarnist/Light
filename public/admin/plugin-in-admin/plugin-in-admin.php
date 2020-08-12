<article class="statistiques">
	<header class="row bg-light">
		<div class="offset-lg-4 col-lg-4 border mr-1 mt-3 pt-2">
		  <h2 class="text-muted m-3">Plugin in admin</h2>
		  <h3>Même répertoire et mêmes fichiers que dans root/plugin/ mais ici, il faut se connecter...</h3>
		</div>
    </header>
	<div class="row">
		<div class="offset-lg-4 col-lg-4 border mr-1 mt-3 pt-2">
			<p>L'url "index.php?page=plugin-in-admin" va chercher un répertoire avec ce nom  si aucune vue n'existe avec ce nom: root/view/plugin-in-admin.php. Ensuite il cherche la vue "plugin-in-admin/plugin-in-admin.php" dans ce répertoire et son contrôleur s'il existe : plugin-in-admin/plugin-in-admin-controller.php</p>
			<p>On peut imaginer aussi, qu'il cherche d'abord plugin-in-admin/index.php ...</p>
			<p class="text-center"><?=isset($plugin)?$plugin:"inconnu"?></p>
		</div>
	</div>
</article>