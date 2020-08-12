<header>
	<h2>Vue par défaut</h2>
</header>
<article>
	<p>Page affichée automatiquement si votre page web n'est pas trouvée...</p>
	<p><i>(Message de <?=__FILE__?> )</i></p>
	<p>Nom de la page (view/nom de la page) non trouvée: <?=$page->getPageName();?></p>
	<p><a href="accueil"><button class="btn">Aller à l'accueil</button></a></p>
</article>