<!--

																	Model
	File : root/models/config-file-reading-short
	"short" : only table with values. No list ol.
	Author : Marc Harnist
	Date : 2020-07-01
	
	Thema
	Display config file constants to edit them
	
-->
	<style>
		h3 { margin-top: 20px;}
		.table_constants td { border: 1px dotted white; padding:10px;}
		.table_constants th {
			border: 1px dotted #22609E;
			padding:10px;
			background-color:white;
			color: #22609E!important;
			text-align: center;
		}
	</style>

    <p><i>Modèle importé : root/modèle/config-file-reading-short.php</i></p>

    <h4 class="h3"><i>Thème</i></h4>

    <p>Déplacer Alpha vers root/config/config.php en rendant les valeurs de config paramétrables dans
		un formulaire de l'administration du site web.<p>    

    <hr>

    <p>
    <?php
    $rejectedCars = ["define", "(", "'",'"',")",";", " "];
    $CsvFileSeparator_line= "\n";
    $CsvFileSeparator_fields = ",";
    $CsvFileSeparator_column = ",";
    $CsvFileSeparator_attributs = "@@";
    $viewTableNumberOfColumns = 2;
	$text = "";
	$constants = array();//Will receive config values
	
    // II. FUNCTIONS  //////////////////////////////////////////////
	//
    //Check if file well exists
	$repere = "( Message de ".__FILE__ . " ligne " . __LINE__ . ")";
    is_file($configFile)?print("Le fichier $configFile a bien été trouvé. $repere"):exit("Fichier $configFile non trouvé. $repere");
    
	//Read the file and push its content in a var array()
    $configFileContent = $methods->readFile($configFile, $CsvFileSeparator_line);
    ?>
    </p>
	
    <?php
	//If file not false and not empty, continue. Else, displays an error message line 88
	if($configFileContent !== False and $configFileContent !== "")
	{
		foreach($configFileContent as $line)
		{
			//Example of line of config file 
			// define('WEBSITE_NAME', "Light");//WEBSITE_NAME = constant

			//Search line wich begin with "define"
			if(strpos($line, "define") === False) 
				continue;//Else, go to next line, exit the loop "foreach"

			//Delete comments
			$is_comment = strpos($line, "//");//Check if // is in string (return false of int)
			if($is_comment) 
				$line = substr($line, 0, strpos($line, "//"));//Delete all after //
			
			//Delete not wished cars
			$line = str_replace($rejectedCars, "", $line);

			//Create array with values
			$constants[] = explode(",",$line);
		}
	}
	//Else displays an error message
	else echo __LINE__ . " Fichier \"$configFile\" illisible !<br>";
    ?>

	<h3>Les constantes du fichier config</h3>

	<table class="table_constants">
	<tr><th>Array key</th><th>Constante</th><th>Valeur</th></tr>
	<?php
				foreach($constants as $key => $constant)
				{
					echo "<tr><td class=\"text-center\">$key</td><td>$constant[0] </td><td> $constant[1]</td></tr>";
				}
	
	?>
	</table>
	
	<h3>Suite du chantier</h3>
	
	<p>Modifier les valeurs des constantes dans un formulaire de l'administration du site
	en se servant des "array key" comme repère !</p>
