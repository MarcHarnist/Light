<?php
/**  Controler "donneesAnalyse.php" (data analyse)
*    @Author : Marc L. Harnist
*    @Date : 2020-06-29
*
*   WORK IN PROGRESS
*   Writing function readServerDatabase()
*   Controler : only Php, no html, nor css, nor Light datas but this website data !
*   No fixed data
*/  
	/** I. VARIABLES */
	$methods = new Methods;//Get and store a lot of usefull methods in the variable $methods ;
	$database = new Database;//Connect to database and upload sql requests usefull methods ;
	$rightLevelThisPage = 5;// 5 = all clients rights (not public). Client must be connected.
	$DatabaseGreenServer = new Database;
		
	//Redirect user "client" to homepage if not enought rights
	$website->clientsPermissions($rightLevelThisPage, $client);
	
	// ****************************************************************//
	// ****************  END OF CONTROLER   ***************************//
	// ****************************************************************//



	// ****************  INC HEADER     ****//
	file_exists($page->getHeaderPath()) ? include_once $page->getHeaderPath() : print('<p>'.$page->getHeaderPath().' introuvable.</p>');



	// ****************************************************************//
	// ****************                 *******************************//
	// ****************      VIEW       *******************************//
	// ****************                 *******************************//
	// ****************************************************************//
	// Vue : données brutes, html, peu de php
?>
<article>
    <header class="row">
      <h2 class="h1 col-lg-12 ml-0 mt-4 ">Données Analyse</h2>
   </header>   
  <section class="col-lg-12">
		<h3 class="h5 ">Les données que vous avez sélectionnez</h3>
		<p><img class="infoIcone" src="img/info.jpg" alt="Icone information img/info.jpg">
			Cliquez sur le bouton "consulter le serveur" en bas de page pour lancer la recherche de données dans le serveur.
		</p>
		<?php
		
		//Exit if no data choosen to display
		(isset($_POST) && !empty($_POST))?:exit("Aucune donnée choisie.");

		//VARIABLES

		//Text displayed in html page for answer
		$text = "";
		
		//Words to erase from text
		$wordToErase = "Compteur";
		
		$text ="<ol>";
		
		foreach($_POST as $key => $value)
		{
			//Clean $key and $value from useless spaces or ugly cars
			$value = trim($value);
			$key = str_replace("_", " ", $key);

			//Email special displaying
			if($key === "email") $text .= "<li><strong>Email : </strong>$value </li>";

			//Other displayings
			//If $value is not empty or only one space or called "update", it wont be displayed
			elseif($value != "update" && $value !== " " && $value !=="")
			{
				//If the wordToErase belongs to this string apply the code below
				if(strpos($value, $wordToErase) !== false && strpos($value, $wordToErase)>1)
				{
					//Replace the word to erase by a )
					$value = " " . str_replace($wordToErase, "(", $value);
					$value .= ")";//Close the )
				}
				$line = "<li><strong>$key</strong> : $value.</li>";
				$text .= $line;
			}
		}
		$text .= "</ol>";
	?>
		<?=$text;?>
		<form method="post" action="index.php?page=donnees-analyse-ask-server">
		<?php
		if(isset($_POST) && !empty($_POST))//Store posts in a session()
		    $_SESSION['POSTS'] = $_POST;


		?>
			<input type="submit" value="Consulter le serveur">
		</form>
		<hr>
		<p><a class="btn btn-primary mb-1 mt-2 not-printed text-white" data-toggle="collapse" href="#globales" role="button" aria-expanded="false" aria-controls="globales">Voir les données brutes de la variable super globale $_POST</a></p>

		<div class="collapse not-printed" id="globales">
			<div class="card card-body">
				<div class=" ">
					<pre>
					<?php
							print_r($_POST);
					?>
					</pre>
				</div>
			</div>
		</div>
</article>
