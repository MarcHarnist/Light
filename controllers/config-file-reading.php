<!--
                       Model Config-file-reading

	@File : root/models/config-file-reading
	@Author : Marc Harnist
	@Date : 2020-07-01
	Theme : Display config file constants to edit them
-->
<style>
h3 {
	margin-top: 20px;
}

.table_constants td {
	border: 1px dotted white;
	padding: 10px;
}

.table_constants th {
	border: 1px dotted #22609E;
	padding: 10px;
	background-color: white;
	color: #22609E !important;
	text-align: center;
}
</style>

<p>
	<i>Modèle importé : root/modèle/config-file-reading.php</i>
</p>

<h4 class="h3">
	<i>Thème</i>
</h4>

<p>Rendre les valeurs de config paramétrables dans un formulaire de l'administration du site web.

<hr>

<p>
    <?php
	$countLines = 0;
    $constants = array(); // Will receive config values
	$listeConst = array();
    $csvFileSeparator_line = "\n";
    $csvFileSeparator_linesFields = ",";
    $csvFileSeparator_linesComments = "//";
    $originalCode = "";
    $originalText = "";
    $rejectedCars = [
        "define",
        "(",
        "'",
        '"',
        ")",
        ";"
    ];
    $constantsWithSpaces = [
        "SUBTITLE",
        "WEBSITE_NAME",
        "WEBMASTER",
        "WEBSITE_OWNER"
    ]; // Allowed spaces in values

    // II. FUNCTIONS //////////////////////////////////////////////
    //
    // Check if file well exists
    $repere = "( Message de " . __FILE__ . " ligne " . __LINE__ . ")";
    is_file($configFile) ? print("Le fichier $configFile a bien été trouvé. $repere") : exit("Fichier $configFile non trouvé. $repere");

    // Read the file and push its content in a var array()
    $configFileContent = $methods->readFile($configFile, $csvFileSeparator_line);
    ?>
    </p>

<?php
// If file not false and not empty, continue. Else, displays an error message line 88
if ($configFileContent !== False and $configFileContent !== "") {
    foreach ($configFileContent as $key => $line) 
	{
        // Example of line of config file
        // define('WEBSITE_NAME', "Light");//WEBSITE_NAME = constant

		$comment = "";

        $originalCode .= $line; // Original text

        // Freeze PHP tags
        $line = str_replace("<", "< ", $line); // Or: $line = str_replace("<", "'<'", $line);

        $originalText .= $line; // Add line to original text

        // Search line wich begin with "define"
        if (strpos($line, "define") === False)
            continue; // Else, go to next line, exit the loop "foreach"
		
		// Delete not wished cars
		$line = str_replace($rejectedCars, "", $line);
        
        // Create array with values
        $constants[$countLines] = explode($csvFileSeparator_linesFields, $line);

		//Create variables for list of constants
        $constantName =  $constants[$countLines]["constantName"] = $constants[$countLines][0];
        $constantValue = $constantValueWithComment = $constants[$countLines][1];
		
        //Delete comment from constantValue
        if(strpos($constantValueWithComment, "//"))//Check if // is in string (return false of int)
            $constantValue = substr($constantValueWithComment, 0, strpos($constantValueWithComment, "//"));//Delete all after //

		//Search comment
        $explodeFromComment = explode("//",$constantValueWithComment,2);
		if(isset($explodeFromComment[1])) $comment = $explodeFromComment[1];    

		//Add variables to a list
		$listeConst[$key] = [$constantName, $constantValue, $comment];

	
        // Unwanted spaces management
        foreach ($listeConst as $key => $constant) {
            $listeConst[$key][1] = trim($listeConst[$key][1]); // Erase space at begin and end of values
            $listeConst[$key][2] = trim($listeConst[$key][2]); // Erase space at begin and end of values
            if (in_array($listeConst[$key][0], $constantsWithSpaces) === False)
                $listeConst[$key][1] = str_replace(" ", "_", $listeConst[$key][1]); // Replace " " by _
        }
    }
} // Else displays an error message
else
    echo __LINE__ . " Fichier \"$configFile\" illisible !<br>";

// Add pre tag to $originalCode to display in html page
$originalCodeWithPre = "<pre>" . $originalCode . "</pre>";
?>
<h3>Texte original</h3>
<pre><?=$originalText;?></pre>
<h3>Les constantes du fichier config</h3>
<form method="post"
	action="<?=$website->page_url. 'config-file-edition.php'?>">
	<table class="table_constants">
		<tr>
			<th>Array key</th>
			<th>Constante</th>
			<th>Valeur</th>
			<th>Commentaire</th>
		</tr>
<?php  foreach ($listeConst as $key => $constant) : ?>
<tr>
			<td class="text-center"><?=$key?></td>
			<td><?=$constant[0]?></td>
			<td><input class="btn text-white" type="text"
				name="<?=$constant[0]?>" value="<?=$constant[1]?>"></td>
			<td><input class="btn text-white" type="text"
				name="<?=$constant[0]?>/comment" 
				value="<?=$constant[2]?>"></td></tr>
	<?php
endforeach
;
?>
	</table>
	<input type="submit" value="Enregistrer">
</form>

<h3>Suite du chantier</h3>

<p>Modifier les valeurs des constantes dans un formulaire de
	l'administration du site en se servant des "array key" comme repère !</p>
