<!--
								INSTALL.PHP
                     Fichier d'installation du CMS Light
                                    MH
                                 22 V 2020
-->
<article>
	<section class = "m-1 mt-3">
		<p>Paramétrez votre site web et votre base de données. Votre hébergeur possède les informations nécéssaires en cas de besoin.</p>
			
		<p>Bienvenue sur le CMS "Light". Avant de nous lancer, nous avons besoin de certaines informations sur votre base de données. Il va vous falloir réunir les informations suivantes pour continuer.</p>
		<ul>
		<li>Nom de la base de données</li>
		<li>Nom d’utilisateur MySQL</li>
		<li>Mot de passe de l’utilisateur</li>
		<li>Hôte de base de données</li>
		</ul>
		
		<p>Nous allons utiliser ces informations pour créer le fichier light-config.php. Si pour une raison ou pour une autre la création automatique du fichier ne fonctionne pas, ne vous inquiétez pas. Sa seule action est d’ajouter les informations de la base de données dans un fichier de configuration. Vous pouvez aussi simplement ouvrir light-config-sample.php dans un éditeur de texte, y remplir vos informations et l’enregistrer sous le nom de light-config.php.</p>

		<p><a href="http://marcharnist.fr/notebook/index.php?page=contact">Nous contacter en cas de besoin.</a></p>

		<p>Vous devriez normalement avoir reçu ces informations de la part de votre hébergeur. Si vous ne les avez pas, il vous faudra le contacter pour  continuer.</p>
		
		<p><label for="db_name">Nom de la base de données</label> <input name="db_name" id="db_name" type="text" size="25"></p>
		
		<p><label for="db_username">Identifiant</label> 
		<input name="db_username" id="db_username" type="text" size="25" value="utilisateur" /></p>
		<p><label for="db_password">Mot de passe de la base de donnée</label> 
		<input name="db_password" id="db_password" type="text" size="25" value="mot de passe" autocomplete="off" /></p>
		<p><label for="db_host">Adresse de la base de données</label> 
		<input name="db_host" id="db_host" type="text" size="25" value="localhost" /> 
		( Si "localhost" vous est inconnu, contactez l’hébergeur de votre site.)			</p>
		<!-- Prefixe à coder comme wordpress?
		<p><label for="prefix">Préfixe des tables</label> 
		<input name="prefix" id="prefix" type="text" value="light_" size="25" /> 
		( Préférable si vous utiliserez plusieurs blogs.)</p>
		-->
		<p><input name="submit" type="submit" value="Envoyer" class="button button-large" /></p>
</article>

<article>
<!-- COMMUNICATION SUR LES TRAVAUX EN COURS -->
			<hr>
			<h5 style="color: green;margin-top:20px;">Travaux en cours</h5>
			<p style="color: green;">
			Fichier à imiter : wordpress/wp-admin/setup-config.php. Théme: écriture dans un fichier. Intéressant : les conditions ternaires avec defined() qui vérifie si la constante existe avant de continuer. Autre objet intéressant : le mot clé "continue" dans un foreach qui passe au label suivant sans continuer la suite du code. Voir aussi les case : dans setup-config à la suite... <br>
			Voici un extrait du fichier wp-config-sample.php. Les lignes sont identiques. Le code va chercher le mot clé "define( 'DB_NAME')" et va modifier la ligne. <br>
<pre>			
// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'votre_nom_de_bdd' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'votre_utilisateur_de_bdd' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'votre_mdp_de_bdd' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8' );
</pre>
			<p style="color: green;">
			Ce projet demande encore du temps parce que l'on va écrire dans un fichier de configuration si la connexion a la db a réussi.<br>
			La création de la table et l'enregistrement d'une première entrée, soit la création d'une première news dans le blog fonctionne bien.<br>
			Le code php doit vérifier que le fichier config n'est pas déjà paramétré<br>
			Le nom du site web, l'identifiant, le mot de passe et le mail de l'utilisateur, seront demandés après la connexion à la db.</p>
			<p style="color: green;">
			Quand tout a fonctionné on affiche un message de félicitation à l'utilisateur : "<br>
				Quel succès !<br>
				WordPress est installé. Merci et profitez bien !<br>
				Identifiant	Marc<br>
				Mot de passe	<br>
				Le mot de passe que vous avez choisi."</p>
<!-- COMMUNICATION SUR LES TRAVAUX EN COURS -->
	

		<h4>Créer une table</h4>
		<form method="post">
			<p>Nom de la table à créer ( lettre ou _ avec un minimum 3 caractères...) <br>
			<input name="nom_de_la_table" pattern="[A-Za-z_]{3,}"> 
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
		
		<p><?=$message;?></p>
		
	</section>
	<?php
    }	
    ?>
</article>