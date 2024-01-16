<article>
	<section>
	  <header class="row bg-light">
		<h2 class="row ml-0 text-muted h3">Bonjour <?=isset($member_name)?$member_name:"";?>, bienvenue sur votre profil</h2>
		<?php 
		if(1>2):?>
			<p>Vous êtes sur la nouvelle page <?= __FILE__ ?>.
		<?php
		endif;
		if(!isset($member_name)):?>
		<p class="text-success">Message pour le webmaster : $member_name est inconnu. Controller non trouvé?<br>
		<small><i>Fichier <?= __FILE__ ?></small></i></p>
		<?php 
		endif;?>
	  </header>
		<fieldset class = "fieldset_profil">
		  <?=isset($level)?"<p>Vous êtes connecté. Votre niveau: $level</p>":""?>
		  <?php
		  if(isset($member) && $member->level < 3){
			?>
			<ul>
				<li>Utilisateurs et visiteurs
					<ul>
					  <li><a href="index.php?page=statistiques">Statistiques</a></li>
					  <li><a href="index.php?page=users">Utilisateurs</a></li>
					</ul>
				</li>
				<li>Articles
					<ul>
					  <li><a href="<?= $website->page_url;?>page-creation">Créer une nouvelle page</a></li>
					  <li><a href="<?= $website->page_url;?>pages-index&categorie=pages">Modifier les pages existantes</a></li>
					</ul>
				</li>
				<li>Questions
					<ul>
					  <li><a href="<?= $website->page_url;?>riasec-questions-manager">Gérer les questions</a></li>
					</ul>
				</li>
			  <?php
		  }
		  if(isset($member) && $member->level < 2){
			?>
				<li>Plugins !
					<ul>
					  <li><a href="index.php?page=plugin">Le répertoire plugin existe. La class Page le trouvera dans avec sa méthode setViewPath()</a></li>
					  <li><a href="index.php?page=plugin-in-admin">Le répertoire plugin-in-admin : même répertoire mais nécessite une connexion toujours demandée dans la class Page !</a></li>
					  <li>Ce qu'on peut améliorer : chercher s'il y a un fichier index dans le plugin. Et son contrôleur index-controller.php ?</li>
					</ul>
				</li>
				<li>Config
					<ul>
					  <li><a href="index.php?page=config-file-read">Modifier la configuration du site</a></li>
					</ul>
				</li>
				<li>Bac à sable
					<ul>
					  <li><a href="<?= $website->page_url;?>bac">Travaux de développement en cours</a></li>
					</ul>
				</li>
			  <li>Membres
				<ul>
				  <li><a href="<?= $website->page_url;?>__member-register">Ajouter un membre</a></li>
				  <li><a href="<?= $website->page_url;?>__member-index">Modifier les membres</a></li>
				</ul>
			  </li>
			  <li>Base de données
				  <ul>
					<li><a href="index.php?page=backup-manager">Backup manager</a></li>
					<li><a href="https://phpmyadmin.cluster021.hosting.ovh.net/index.php?db=marcharnssmarc">OVH myAdmin (marcharnssmarc.mysql.db)</a></li>
				   </ul>
			  </li>
				<li>Clients
					<ul>
					  <li><a href="<?= $website->page_url;?>__client-index">Clients</a></li>
					</ul>
				</li>
				<li>Fichiers (hs)
				  <ul>
						<li><a href="<?= $website->page_url;?>__uploader-file">Uploader de fichier</a></li>
						<?php if(isset($member) && $member->level < 2) {?>
						<li><a title = "Editer les fichiers" href="<?= $website->page_url;?>__explorer">Explorateur</a></li>
						<?php } ?>
				   </ul>
				</li>
			</ul>
			<?php
		  }
		  ?>
		  
			  <?php if(isset($member) && $member->level < 2) {?>
					<ul><li><a title = "budget" href="<?= $website->page_url;?>budget-index">Budget</a></li></ul>
			  <?php } ?>
		</fieldset>
	  </section>
</article>