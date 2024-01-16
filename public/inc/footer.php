		</main><!-- Usefull to get min-height for the view -->

		<!-- IMPORT ANIMATION -->
		<?php
		if(defined('PUBLIC_PATH')&& defined('ANIMATION_DISPLAY'))
			$animationPath = PUBLIC_PATH."/inc/animation.php";
		if(isset($animationPath) && is_file($animationPath) && ANIMATION_DISPLAY === "yes")
			require_once($animationPath);
		?>
		<footer> <!-- Footer (Fr: pied de page) -->
			<!-- IMPORT MENU FOOTER -->
			<?php
			if(defined('PUBLIC_PATH')&& defined('MENU_FOOTER_DISPLAY'))
				$menuFooterPath = PUBLIC_PATH."/inc/menu-footer.php";
			if(isset($menuFooterPath) && is_file($menuFooterPath) && MENU_FOOTER_DISPLAY === "yes")
				require_once($menuFooterPath);


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
		<script src="./js/jquery-3.6.0.js"></script>
		<script src="./js/popper.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		
		<!-- Hello dear visitor! - bb-code créé par M.L. Harnist le 8/04/2018 Source: OpenClassRoom -->
		<script src="js/bb-code.js"></script>

	</body>
</html>