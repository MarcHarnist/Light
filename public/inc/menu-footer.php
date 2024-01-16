	<menu class="footer">
		<ul class="nav col-md-12 col-lg-8 h6 justify-content-end"><!-- usefull to W3C-validator -->
			<li class="nav-item">
				<a 	class="mr-2"
					title = "Mensions légales du site web"
					href="Mentions-legales">
					<i class="fas fa-gavel fa"></i></a>
			</li>
			<li class="nav-item">
				<a  class="mx-2 text-light"
					title = "Se connecter à l'administration du site"
					href="connexion">
					<i class="fa fa-user" aria-hidden="true"></i>
				</a>
			</li>
				<!-- ESPACE MEMBRE - BOUTONS DE CONNEXION -->
				<?php
				if(isset($_SESSION['member'])){
					?>
			<li class="nav-item">
				<a  class="mr-2"
					title = "Se déconnecter"
					href="<?=$website->page_url;?>__member-deconnection">
					<i class="fa fa-power-off text-danger" aria-hidden="true"></i>
				</a>
			</li>
				<?php
				}
				?>
			<li>
				<address>Propulsé par 
					<?php
					if(defined("GITHUB_REPOSITORY"))
					{
						?>
						<a target="_blank" href="<?=GITHUB_REPOSITORY;?>" title="CMS Light">
						<?php
					}
					?>
					Light
					<?php
					if(defined("GITHUB_REPOSITORY"))
					{
						?>
						</a>
						<?php
					}
					?>
					, CMS exigeant peu de ressources créé par 
					<?php
					if(defined("KLINY_MANALA"))
					{
						?>
						<a target="_blank" href="<?=KLINY_MANALA;?>" title="Adresse du site Kliny Manala de Marc Harnist">
						<?php
					}
					?>
					Kliny Manala
					<?php
					if(defined("GITHUB_REPOSITORY"))
					{
						?>
						</a>
						<?php
					}
					?>
					.
				</address>
			</li>
		</ul>
	<menu>