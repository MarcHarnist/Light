<?php
/** Controler Donnes (data)
*   @File : Controler client-index
*   @Author : Marc L. Harnist
*   @Date : 28/08/2018
*
*   General remark
*   Only PHP in controllers files. No html if possible, nor css, nor Light datas but this website data !
*/  

/** I. VARIABLES
*
*/
$rightLevelThisPage = 5; //Define the user rights level. 5 = all clients rights but not public
$dataFileVersion = "dev";//only a few line of original dataFile for faster dev and tests
$dataFileVersion = "dev-II";//only a few line of original dataFile for faster dev and tests
$dataFileVersion = "III";//complete data source file
$fileCsv = "upload/files/metadatacrunch-".$dataFileVersion.".csv"; // Fichier source à lire
$rejectedCars = ["\"", "'"];//Those cars will be erased from text to protect final html code
$CsvFileSeparator_line= "\n";
$CsvFileSeparator_fields = ",";
$CsvFileSeparator_column = ",";
$CsvFileSeparator_attributs = "@@";
$viewTableNumberOfColumns = 2;//Beautiful table = 2 (2 columns)
$viewTableNumberOfColumns = 2000000;//All columns demanded by the Mydataball's website owner
$dropdownListName = "";//The name of the list in the form of the right column

/** II. Actions
*   Actions use functions stored below, in this file, or in classes (root/classes)
*   Coming soon: functions will be storend in models (root/models)
*/
//First, redirect user to homepage if not connect as client or if the client has not enought rights to be here
isset($client)?$website->clientsPermissions($rightLevelThisPage, $client):exit("Il faut se connecter en tant que client pour voir cette page.");

//Connect to database and upload usefull methods (sql requests)
$database = new Database;

//Get all the connected client's data from database and push them in the variable $clientOnline
$clientOnline = (isset($client) && null !== $client->id() && is_int($client->id())) AND $clientOnline = $database->getOneClientById($client->id());

//Get usefull methods
$methods = new Methods;//Get and store a lot of usefull methods in the var. $methods

//Open the file.csv and push its content in a variable (here: $CsvFileContent)
$CsvFileContent = $methods->readFileCsv($fileCsv, $CsvFileSeparator_line);

//Displays the file.csv lines in a html table for the view, using the function displayLines (see below in this file)
$tableauHtmlFinal = displayLines($CsvFileContent, $CsvFileSeparator_fields, $viewTableNumberOfColumns, $CsvFileSeparator_attributs);

/** III. FUNCTIONS 
*
*/
//Create view html table columns
function columnsCreator(string $string, string $CsvFileSeparator_attributs, string $dropdownListName){

	//Variables
	$dropDownList = "";
	$radioName = "";
	$dropDownList = '<select id="'.$dropdownListName.'" name="'.$dropdownListName.'">';
	
	//FIRST COLUMN LEFT
	//Detect first column //No $CsvFileSeparator_attributs in this string: we are in the first column of the view table
	//Check if $CsvFileSeparator_attributs exists in the string
	if(strpos($string, $CsvFileSeparator_attributs) === False)
	{
		$cellContent = createFirstColumnForm($dropdownListName);//Create the input with the sentence
	}
	else //The Csv file separator is in this string : second and other columns
	{	

		//Transform string to table
		$attributs = explode($CsvFileSeparator_attributs, trim($string));
		
		//Erase spaces at begin and end of all array's elements
		$attributs = array_map( 'ltrim', $attributs);

		//Get all attributs
		foreach($attributs as $attributElement)
		{
			//Erase word
			$wordToErase = "Attribut ";
			
			//Erase spaces at begin and end of the sentence and erase the word "Attribut" too
			$optionSentence = trim(str_replace($wordToErase, "", $attributElement));//Erase spaces at begin and end of the sentence

			//Create dropdown list
			//Create the dropDownList options with the sentence
			$dropDownList .= createOption($optionSentence);
			
			//Create a label the same way
			$dropDownList .= creationLabel($optionSentence);
		}
		$dropDownList .= '</select>';//close dropDownList 
		$cellContent = $dropDownList;//right columns cell content
	}
	return "<td> $cellContent </td>";//Add the cell content of in all columns
}
//Create a checkbox
function createOption(string $string = ""){
    return '<option value="'.$string.'">'.$string.'</option>';
}
//Create an input label
function creationLabel(string $string){
	return  '<label for="'.$string.'">'.$string.'</label>';
}

//Create a hidden input for the first column left (questions)
function createFirstColumnForm(string $string = "controllerDonneesDefaultString1"){
	return creationLabel($string);
}

// TRAINING TO PROGRESS: METHODS PARAMETERS TYPAGES (array, string, int...) BELOW 
//Create an html table with csv file data
function displayLines(array $CsvFileContent, string $CsvFileSeparator_column, int $viewTableNumberOfColumns, string $CsvFileSeparator_attributs)
{
	//VARIABLES
	$rejectedLinesCounter = 0;//Count all much lines not displayed in case of all colmns are not displayed ($viewTableNumberOfColumns)
	$csvFileTitleToErase = "Value,attributs";//Example of title : "Value,attributs"
	$methods = new Methods;//Get the tool box: several usefull methods
	$CsvFileContent = $methods->cleanRejectedCars($CsvFileContent); // $CsvFileContent = file.csv; $CsvFileSeparator_column = ",";
	
	//Go through all the lines of the file and transform them into a table line with <tr> and <td>
	foreach($CsvFileContent as $key => $line)
	{
		//Variable table cell (<td>)
		$table_tds = "";

		//If this line is not the file.csv title we continue
		if($line !== $csvFileTitleToErase)
		{
			//Create columns by separating lines where there is the first comma or other separator
			$fields = explode($CsvFileSeparator_column, $line, 2);//2 = explode in 2 parts only

			//Dropdown list name = $field[0];
			$dropdownListName = $fields[0];
			
			//Keep only lines that do not exceed the number of columns chosen at the start
			if(count($fields) <= $viewTableNumberOfColumns)
			{
				//Apply a style to the fields
				foreach($fields as $field)
				{
					//Erase " and ' to protect html code
					$field = $methods->cleanRejectedCars($field);
					$table_tds .= columnsCreator($field, $CsvFileSeparator_attributs, $dropdownListName);
				}

				//To do : move the <tr> to the view 
				$dataHtmlTableTr[] = "<tr>" . $table_tds . "</tr>\n\t\t\t\t\t\t";
			}
			else
			{
				//Erase " and ' to protect html code
				$field = $methods->cleanRejectedCars($fields[0]);
				$dataHtmlTableTr[] = "<tr><td> - ".$field."</td>
				<td><p class=\"messageErreur\"><i>Ligne avec trop de colonnes en résultat. Résultat non affiché.</i></td></tr>\n\t\t\t\t\t\t";
				$rejectedLinesCounter++;
			}
		}
	}
	return $dataHtmlTableTr;//Returned value by the function "displayLines(array $CsvFileContent, string $CsvFileSeparator_column)"
}//Close "	function displayLines(array $CsvFileContent, string $CsvFileSeparator_column) "