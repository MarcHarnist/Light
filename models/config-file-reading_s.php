
<h1 class="bg-white text-danger p-3">Ce code affiche le commentaire du domaine mais affiche un chiffre 1. Pourquoi? L'enregistrement se passe mal.
</h1>


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
	<i>Modèle importé : root/modèle/config-file-reading-short-complete.php</i>
</p>

<h4 class="h3">
	<i>Thème</i>
</h4>

<p>Rendre les valeurs de config paramétrables dans un formulaire de l'administration du site web.</p>
<hr>

<p>
    <?php
    $constants = array(); // Will receive config values
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
    foreach ($configFileContent as $line) {
        // Example of line of config file
        // define('WEBSITE_NAME', "Light");//WEBSITE_NAME = constant

        $originalCode .= $line; // Original text

        // Freeze PHP tags
        $line = str_replace("<", "< ", $line); // Or: $line = str_replace("<", "'<'", $line);

        $originalText .= $line; // Add line to original text

        // Search line wich begin with "define"
        if (strpos($line, "define") === False)
            continue; // Else, go to next line, exit the loop "foreach"

        // Delete not wished cars
        $line = str_replace($rejectedCars, "", $line);
        
        /*
        line 143    var_dump($constants[0]);
            
        C:\wamp64\www\marcharnist\www\mydataball\models\config-file-reading.php:137:
        array (size=6)
        0 => string 'DOMAIN' (length=6)
        1 => string 'mydataball//com' (length=15)
        2 =>
                array (size=2)
                0 => string 'mydataball' (length=10)
                1 => string 'com' (length=3)
        'nomConstante' => string 'DOMAIN' (length=6)
        'domain' => string 'mydataball' (length=10)
        'comment' => string 'com' (length=3)
        */
        
        // Create array with values
        $constants[] = explode($csvFileSeparator_linesFields, $line);
        $constantName =  $constants[0]["constantName"] = $constants[0][0];
        $constantValue = $constants[0]["constantValue"] = $constants[0][1];
        
        //Delete comment from constantValue
        $is_comment = strpos($constantValue, "//");//Check if // is in string (return false of int)
        if($is_comment)
            $constantValue = substr($constantValue, 0, strpos($constantValue, "//"));//Delete all after //

//         $comment = split    
            
         var_dump($comment);
         die();
        
        //Get comment if exists
        $constants[0][2] = explode($csvFileSeparator_linesComments, $constants[0][1]);
        if (! isset($constants[0][2][1]))
            $constants[0][2][1] = "no comment";

        $constants[0]["comment"] = "";
        $constants[0]["comment"] = $constants[0][2][1];
        
    
        // Management of unwanted spaces
        foreach ($constants as $key => $constant) {
            $constants[$key][1] = trim($constants[$key][1]); // Erase space at begin and end of values
            if (in_array($constants[$key][0], $constantsWithSpaces) === False)
                $constants[$key][1] = str_replace(" ", "_", $constants[$key][1]); // Replace " " by _
        }
    }
} // Else displays an error message
else
    echo __LINE__ . " Fichier \"$configFile\" illisible !<br>";

    

    
    
    var_dump($constants);



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
<?php  foreach ($constants as $key => $constant) : ?>
<tr>
			<td class="text-center"><?=$key?></td>
			<td><?=$constant[0]?></td>
			<td><input class="btn text-white" type="text"
				name="<?=$constant[0]?>" value="<?=$constant[1]?>"></td>
			<td><input class="btn text-white" type="text"
				name="<?=$constant[0]?>/comment"
				value="<?=isset($constant["comment"]) AND print($constant["comment"]);?>"></td><?php //var_dump($constant)?></tr>
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
