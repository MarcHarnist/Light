<!doctype html>      <!-- www/inc/header  1.0 Hi!  --><html lang="fr">
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width"/>
		<meta http-equiv="Content-Type" Content="text/html; charset=UTF-8">
		
					<!-- Title of the page -->
		<title><?=WEBSITE_NAME . ' ' . $page->getTitle();?></title>

		<!-- Awesome font -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
		<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/v4-shims.js"></script>		<!-- CkEditor -->		
		
		<script src="ckeditor/ckeditor.js"></script>
		
		<!-- Bootstrap (look at the bootom too) -->
		<link rel="stylesheet" href="./css/bootstrap.min.css">
		
		<!-- Style des messages d'erreur ou de succes -->
		<link rel="stylesheet" href="css/message.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/screen.css">

		<!-- If a css file exists for this page + message.css -->
		<?=$page->getCssLink();?>
	<body>
		<header class="row m-0 p-0 w-100">
			<figure class="col-11 col-lg-4">
				<h1>
				<a href="<?=$website->website_url;?>">
					<img
						class="rounded" 
						src="img/logo.png" 
						alt="Logo, img/logo.png"
						height="60">
				
				
				<?=WEBSITE_NAME?></h1>
				</a>
			</figure>
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
					<a class="nav-link"  title = "Page contact" href="<?=$website->page_url;?>contact">
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
		</header>
		<main><!-- main with min-height -->