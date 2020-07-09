		</main><!-- Usefull to get min-height for the view -->
		<footer> <!-- Footer (pied de page) -->
			<ul class="nav col-md-12 col-lg-8 h6 justify-content-end"><!-- usefull to W3C-validator -->
				<li class="nav-item">
					<a 	class="mr-2" 
						title = "Mensions légales du site web"
						href="<?=$website->page_url;?>page-from-pages-index&id=131&categorie=pages&titre=Mentions-légales">
						<i class="fas fa-gavel fa"></i></a>
				</li>
				<li class="nav-item">
					<a  class="mx-2 text-light"
						title = "Se connecter à l'administration du site"
						href="<?=$website->page_url;?>connexion">
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
			</p>
				<address>Propulsé par <a target="_blank" href="http://marcharnist.fr/light" title="CMS Light">"Light"</a>, CMS exigeant peu de ressources créé par <a target="_blank" href="http://marcharnist.fr" title="L'auteur"><?=WEBMASTER;?></a>.</address>

			<?php
				$ok = $ok_2 = $ko = $ko_2 = "";
				if (isset($_SESSION['client']))
					$ok = 'Une session client ouverte';
				else
					$ko = 'Pas de session client ouverte';

				if (isset($_SESSION['member']))
					$ok_2 = 'Une session membre ouverte';
				else
					$ko_2 = 'Pas de session membre ouverte';
				
				/* MESSAGE DISPLAYING FOR DEVELOPPEMENT
				?>
				<p style="background-color: lightgreen;" class="p-2">
					<?=$ok;?><br>
					<?=$ok_2;?>
				</p>
				<p style="background-color: red; color:white" class="p-2">
					<?=$ko?><br>
					<?=$ko_2?>
				</p>
				<?php
				*/

				// store member in session var to economyse a SQL request.
				if(isset($member)){
					$_SESSION['member'] = $member;
					if(is_object($member)) {
						$member = $member->name();
						$_SESSION['member'] = $member;
					}
				}//close if(isset($member))	// store member in session var to economyse a SQL request.

				// store client name in session var to economyse a SQL request.
				if(isset($client)){
					$_SESSION['client'] = $client;
					if(is_object($client)) {
						$client = $client->name();
						$_SESSION['client'] = $client;
					}
				}//close if(isset($client))
			?>
		</footer> <!-- close Footer -->
	
		<!-- Bootstrap inside the website! -->
		<script src="./js/jquery-3.2.1.slim.min.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		
		<!-- Hello dear visitor! - bb-code créé par M.L. Harnist le 8/04/2018 Source: OpenClassRoom -->
		<script src="js/bb-code.js"></script>

	</body>
</html>