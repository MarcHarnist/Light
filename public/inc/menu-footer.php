	<menu class="footer">
		<ul class="nav col-lg-3 col-md-6"><!-- usefull to W3C-validator -->
			<li class="nav-item">
				<a 	class="mr-2" title = "Mentions légales" href="Mentions-legales">
					<i class="fas fa-gavel fa"></i></a>
			</li>
			<li class="nav-item">
				<a  class="mx-2 text-light" title = "Admin" href="connexion">
					<i class="fa fa-user" aria-hidden="true"></i>
				</a>
			</li>
			<?php
			if(isset($_SESSION['member'])): ?>
				<li class="nav-item"><!-- MEMBER SPACE DECONNECTION BUTTON -->
					<a  class="mx-2" title = "Se déconnecter" 
					href="index.php?page=__member-deconnection">
						<i class="fa fa-power-off text-danger" aria-hidden="true"></i>
					</a>
				</li>
				<?php
			endif; ?>
			<li class="nav-item"><!-- MEMBER SPACE DECONNECTION BUTTON -->
			<address class="text-center">Projet de <a href="http://zaabel.fr" target="_blank">Zaabel</a></address>
			</li>
		</ul>
	<menu>