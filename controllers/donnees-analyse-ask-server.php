<?php
/**  Controler "donneesAnalyse.php" (data analyse)
*    @Author : Marc L. Harnist
*    @Date : 2020-06-29
*
*    WORK IN PROGRESS
*    Writing function readServerDatabase()
*    Controler : only Php, no html, nor css, nor Light datas but this website data !
*    No fixed data
*/  
//VARIABLES
	$methods = new Methods;//Get and store a lot of usefull methods in the variable $methods ;
	$mydatabase = new Mydatabase;//Connect to database and upload sql requests usefull methods ;

// GIVE THE RIGHT NAME HERE /////////////////////////////////////////////////////////////////
	$table = "Nom_table_Mydataball";

	$rightLevelThisPage = 5;// 5 = all clients rights (not public). Client must be connected.
	$DatabaseGreenServer = new Database;
	$requireModelSuccesMessage["requireModel"] = [True => " bien importé.", False => " introuvable."];
	$model = "models/connexion-sqlite.php"; //File to import
	$message = "";
	$dbAnswers = array();

//ACTIONS
	//Redirect user "client" to homepage if not enought rights
	$website->clientsPermissions($rightLevelThisPage, $client);//Will compare this client's rights level to $rightLevelThisPage

	//Check if model is found
    if(!is_file($model)) exit($model.$requireModelSuccesMessage["requireModel"][False]);

	//Get $_POSTS stored in session()
	$POSTS = array("No data yet");
	isset($_SESSION['POSTS'])? $POSTS = $_SESSION['POSTS'] : $message = '<span class="bg-white text-danger p-2 ">Pas de $_SESSION[\'POSTS\']</span>';

	
	//For each value et attributs, read the database
	foreach($POSTS as $value => $attributs)
	{
		//Get an array and push it into $dbAnswer variable
		if(isset($value) and $value === "email") continue;
		if(isset($value) and $value === "operation") continue;
		
		//Afficher la valeur dans un var_dump()
		// isset($value)?var_dump($value):print("<p class=\"h3 bg-white text-danger p-2 \">\$valeur n'existe pas!</p>");
		
		//Read the database and add the answer in array $dbAnswer
		$dbAnswer[] = $mydatabase->read_table_databall($table, $value, $attributs);
	}
	unset($_SESSION['POSTS']);
// ****************  END OF CONTROLER   ***************************************************************//
// ****************************************************************************************************//


//                          VIEW      
// ****************************************************************//
// IMPORT INC HEADER
file_exists($page->getHeaderPath()) ? include_once $page->getHeaderPath() : print('<p>'.$page->getHeaderPath().' introuvable.</p>');
?>
<article>
    <header class="row">
      <h2 class="h1 col-lg-12 ml-0 mt-4 ">Réponse de la base de donnée</h2>
    </header>   
    <section class="col-lg-12">
	
		<p>Réponse de la base de donnée : "<?=is_string($dbAnswer)?$dbAnswer:" Pas de réponse de la base de donnée.";?>"</p>
		
		<p>Message du contrôleur : "<?= !empty($message)?$message:" Pas de message du contrôleur.";?>"</p>
		
		<?php if(is_array($dbAnswer)):	?>
		<p>La variable $dbAnswer est un array(): <br>
		<?php 
		foreach($dbAnswer as $key => $value):
		?>
		
		<p>Key : <?=$key?> - Value : <?=$value?></p>
		
		
		<?php
		endforeach;
		
		print_r($dbAnswer);
		else: ?>
		<p>La variable dbAnswer n'est pas un array.</p>
		<?php endif;?>

		<!-- HIDDEN TEXT BEHING A BOOTSTRAP BUTTON -->
		<p><a class="btn btn-primary mb-1 mt-2 not-printed text-white" data-toggle="collapse" href="#globales" role="button" aria-expanded="false" aria-controls="globales">Voir les données brutes envoyée par le formulaire de la page précédente (dans la variable $_POSTS)</a></p>
		<div class="collapse not-printed" id="globales">
			<div class="card card-body">
				<div class=" ">
					<pre>
					<?php
						!empty($POSTS)?print_r($POSTS):print("Aucune valeur à afficher.");
					?>
					</pre>
				</div>
			</div>
		</div>

	</section>
</article>
