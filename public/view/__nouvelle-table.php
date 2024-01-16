<!--
                                 Créer une table
 
                                       MH Light
                                      22 V 2020
-->
<article>
  
	<header class="row bg-light">
    <h2 class="col-lg-12 ml-0 text-muted text-center">Créer une table dans la base de donnée</h2>
	</header>
  
	<section class="mt-1">
	
		<h4>Nom de votre site web</h4>
		
		<!-- COMMUNICATION SUR LES TRAVAUX EN COURS -->
				<h5 style="color: green;margin-top:50px;">Travaux en cours</h5>
				<p style="color: green;margin-bottom:50px;">La création de la table et l'enregistrement d'une première entrée, soit la création d'une première news dans le blog fonctionne bien.<br>
				Il faut à présent demander le nom du site web à l'utilisateur, puis il faudra lui demander le nom de la db avec le mot de passe d'accès et le nom d'utilisateur de la db. Enfin le mail de l'utilisateur et d'autres infos si besoin...<br><br>
				Attention, la sécurité est trop dure: il faut pouvoir créer des noms de table avec underscore _
				Controler __nouvelle-table ligne 57.<br>
								//N'accepte que les lettres dans le nom<br>
								elseif(ctype_alpha($nom_de_la_table) === false)<br>
								<br>
								Ce dode est trop strict. Il devrait pouvoir accepter les underscore dans le nom.<br>
								<br>
								a_new_blog devrait etre accepté.<br>
								
				</p>
		<!-- COMMUNICATION SUR LES TRAVAUX EN COURS -->
	

		<h4>Créer une table</h4>
		<form method="post">
			<p>Nom de la table à créer : <input name="nom_de_la_table" value="a_new_blog"><br>
			<input name="operation" type="hidden" value="creation">
			<input type="submit" value="créer la table"></p>
		</form>
	</section>
	<!-- Section optionnelle de suppression de table 
	<section class="mt-5">
	
		<h4>Supprimer une table</h4>
		
		<form method="post">
			<p>Nom de la table à supprimer : <input name="nom_de_la_table"><br>
			<input name="operation" type="hidden" value="suppression">
			<input type="submit" value="Supprimer la table"></p>
		</form>
	</section>
    -->
	<?php
    if(isset($message) && null !== $message)
    {
    ?>
	<section class="mt-5">
	
		<h4>Message</h4>

		<p style=\"color:white; background-color:green;\"><?=$message;?></p>
		
	</section>
	<?php
    }	
    ?>
</article>