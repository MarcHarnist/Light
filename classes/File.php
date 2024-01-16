<?php
/**	  Classe File.php
 *    Author: Marc L. Harnist
 *	  Date: 06/04/2018
 *	  Updated: 06/04/2018, 29/08/2018, 14/12/2023
 *
 *    Classe "File" child of Methods, child of Websiste
 *	  Controlers using this: __files-edition, __files-save
 *	  Functions inside:
 *      C: construct()...............line  25
 *      R: file_reader().............line  31
 *         read_json_file............line  43
 *         readFileCsv...............line  65
 *       U: file_update()............line 108
 *	    D:supprimer_le_fichier().....line 124
 *         destruction().............line 139
 *       Copy()......................line 151
 */

class File extends Methods {

	public $title;
	public $text;

/** construct().................line 22
*	Description : construit l'objet ici avec les attributs
*   et les méthodes de la classe mère "Methods" (Tools)
*/	public function __construct(){
		parent::__construct();
	}
/** file_reader()...............line 28
*   2. Read file (R from CRUD)
*	Description : lit un fichier et retourne son contenu
*	Paramètres: chemin du fichier $file_path
*	Valeurs retournées : contenu du fichier ou bool false
*	Version : 1.0 Créée le: 29/07/18 MAJ: 29/08/18
*/  function file_reader($file_path = ""){
		if(file_exists($file_path)) // Verify if file or path is correct
			return file($file_path); // Put file content in an array()
		else
			return False; // return an error message: the file is lost
	}
/** read_json_file................line 42
 *  Description: lit un fichier json et retourne le contenu dans un tableau (array)
 *  Paramères: chemin du fichier $filename
 *  valeurs retournées: contenu du fichier ou message d'erreur
 *  Version: 1.0 
 *  Source: https://www.w3resource.com
 */	function read_json_file($filename) {
		try {
			$jsonContents = file_get_contents($filename);
			if ($jsonContents === false) {
				throw new Exception("Error reading the JSON file.");
			}
			$decodedData = json_decode($jsonContents, true);
			if ($decodedData === null) {
				throw new Exception("Error decoding the JSON data.");
			}
			return $decodedData;
		} catch (Exception $e) {
			return "An error occurred: " . $e->getMessage();
		}
	}
/********************************************************************************/
/****** Nom : readFileCsv                                                  ******/
/********************************************************************************/
/****** Description : enregistre le contenu d'un fichier dans une variable ******/
/********************************************************************************/
/****** Paramètres :                                                       ******/
/****** [STRING] $fileName nom et adresse du fichier                       ******/
/********************************************************************************/
/****** Valeurs retournées : tableau                                       ******/
/********************************************************************************/
/****** Auteur : Samuel RENAUD, revisité par Marc Harnist                  ******/
/********************************************************************************/
/****** Version : 1.0                                                      ******/
/********************************************************************************/
/****** Créée le : 19/02/2018                                              ******/
/********************************************************************************/
/****** Modifiée le : 24/06/2020                                           ******/
/********************************************************************************/
function readFileCsv($fileName = 'data', $separateur = ';')
{

	//Tableau de lignes
	$lignes = array();//Lines array
	
	//Vérification des paramètres
	if(!$fileName) return false; //Retrun false if the variable does not exist
	
	if(!is_file($fileName)) return false;//Return false if the file does not exist
	
	//Récupération des données en lisant le fichier "data"
	$data = file($fileName);
	
	//Boucle de lecture du fichier des données
	foreach ($data as $value) 
	{
		//On utilise les points virgules pour séparer les champs
		$infos = explode($separateur,$value);

		//Retourner un tableau de lignes
		$lignes[] = $value;
	}
	return $data;
}
/** file_update()...............line 108
*   3. Update files (U. from CRUD)
*	Description : update a file with sent content (text)
*	Paramètres: file path and new content
*	Valeurs retournées : rien
*	Version : 1.0 Créée le: 29/07/2018 MAJ: 29/07/2018
*/  function file_update($post){
		$this->title = $post['title'];
		$this->text  = $post['text'];

		// First save a copy!
		$this->copy($this->title);

		// Paste the content in the file
		file_put_contents($this->title, $this->text);
	}
/**	supprimer_le_fichier()......line 70
 *   4. Delete file: D from CRUD
*	Description : creates a backup copy
*	Paramètres: $title: $file_path
*	Valeurs retournées : booléen
*	Version : 1.0 créée le: 29/07/2018 MAJ: 29/07/2018
*/  function supprimer_le_fichier($file_path = ""){
		if(file_exists($file_path)){
			if(stristr($file_path, 'copie')){
				unlink($file_path);
				return True;
			}
		} else
			return False;
	}
/**	destruction()..............line 86
*   4. Delete file: D from CRUD
*	Description : détruit un fichier sans faire de copie
*	Paramètres: $get = $_GET avec operation, file realpath
*	Valeurs retournées : booléen
*	Version : 1.0 créée le: 29/07/2018 MAJ: 29/07/18, 30/08/18
*/ 	public function destruction($get){
		if(isset($get['operation']) && $get['operation'] == "delete" && isset($get['fichier']) && is_file($get['fichier'])){
			unlink($get['fichier']);// unlink détruit le fichier - unlink erase the file
			return True;
		}
	}	
/**	copy()......................line 56
*	Description : creates a backup copy
*	Paramètres: $title: file name
*	Valeurs retournées : message d'erreur si bug
*	Version : 1.0 créée le: 29/07/2018 MAJ: 29/07/2018
*/	function copy($title){
	// Create a name for the copy
	$extension = "." . pathinfo($title, PATHINFO_EXTENSION); // Récupération de l'extension
		$title_without_extension = str_replace($extension, '', $title);
		$newfile = $title_without_extension . '-copie-du-' . date('d-m-Y') . $extension;
		// or date('d-m-Y-h-m-s') ...;
		if (!copy($title, $newfile))
		echo "La copie $file du fichier a échoué...\n";
	}
} // Close the class
