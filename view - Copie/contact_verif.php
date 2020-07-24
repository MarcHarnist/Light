<?php
isset($erreur)?'':exit("root/view/contact_verif.php Erreur: le contrôleur est introuvable.");
if (!$erreur) {
	?>
<header>
	<h2>Merci !</h2>
</header>
<article>
	<p class = "messageGreen p_pinkButton">
		Votre message a bien été envoyé, je vous répondrai dans les meilleurs délais.
	</p>
	<p class ="p_pinkButton">
		<a class = "BigPinkButton" href = "<?= $website->page_url . 'accueil';?>">
		Retourner à l'accueil
		</a>	
	</p>
</article>	
	<?php
}
else {
	?>
<header>
	<h2>Message</h2>
</header>
<article>
	<h3>Petite erreur :</h3>
	<?php
	if(($messager->Red()) != ""){
		?>	
		<p class = "messageRed p_pinkButton">
		<?php echo $messager->Red();?>
		<br />
		Mes données ne sont pas perdues:<br />
		<a href="#" onclick="history.go(-1);">J'y retourne en un clic !</a>
		</p>
		<?php
	}
	if(($messager->Green()) != ""){
		?>
		<p class = "messageGreen">
			<?php echo $messager->Green();?>
		</p>
		<?php
	}
	?>
</article>
	<?php
}