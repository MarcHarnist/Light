			<ul class="nav col-md-12 col-lg-8 h6 justify-content-end"><!-- usefull to W3C-validator -->
				<li class="nav-item">
					<a class="nav-link"  title = "Accueil" href="<?=$website->website_url;?>">
					<i class="fa fa-home fa-fw fa-2x" aria-hidden="true"></i> 
					</a>
				</li>
				<!-- ESPACE MEMBRE - BOUTONS DE CONNEXION -->
					<?php
						if(isset($_SESSION['client'])):
					?>
				<li class="nav-item">
					 <a class="nav-link"  title = "données" href="<?=$website->page_url;?>donnees">
					 <i class="fas fa-database fa-2x" aria-hidden="true"></i>
					 </a>
				</li>
					<?php endif; ?>
				<li class="nav-item">
					 <a class="nav-link"  title = "Catégorie: news" href="<?=$website->page_url;?>pages-index&categorie=news">
					 <i class="fas fa-newspaper fa-2x" aria-hidden="true"></i>
					 </a>
				</li>
				<li class="nav-item">
					<a class="nav-link"  title = "Page contact" href="contact">
					<i class="fa fa-envelope-o fa-fw fa-2x" aria-hidden="true"></i> 
					</a>
				</li>
				<li class="nav-item">
					 <a class="nav-link"  title = "Se connecter en tant que client" 
					 href="<?=$website->page_url;?>connexion-client">
					 <i class="fa fa-user fa-2x" aria-hidden="true"></i>
					 </a>
				</li>
				<!-- ESPACE MEMBRE - BOUTONS DE CONNEXION -->
					<?php
						if(isset($_SESSION['client'])){
							// var_dump($_SESSION['client']);die();
					?>
				<li class="nav-item">
					<a class="nav-link text-danger"  title = "Se déconnecter du compte client" href="<?=$website->page_url;?>__client-deconnection"><i class="fa fa-power-off fa-2x text-danger" aria-hidden="true"></i>
					 </a>
				</li>
					<?php
					}
					?>
			</ul>
