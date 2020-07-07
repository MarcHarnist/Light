<!--
                       Model
					   
	File   : root/models/ecrire-dans-un-fichier.php
	Author : Marc Harnist .........................
	Date   : 2020-07-02 ....................... -->
	
<?php	
	// Read and write in a file
	function writeInFile($filePath, $newContent){
		
		// VARIABLES //
		$message["ErrorFileNotFound"] = ["Le fichier à éditer est introuvable.", False];
		$message["NouveauContenuVide"] = ["Aucun contenu à ajouter: contenu vide.", False];
		$message["ok"] = ["Tout s'est bien passé !", True];
		
		if(is_file($filePath) === False) return $message["ErrorFileNotFound"];
		if($newContent === "") return $message["NouveauContenuVide"];

		// Read $filePath and put it in an array
		$oldContent = file_get_contents($filePath); // view = root/view/

		/* Two method now : add new content to the content or replace it
			--> Method one 
				// Add $newContent in $file (decomment to active)
				// $newContent = $oldContent . "\n" . $newContent; 

			--> Method number two
				// Replace the old content by the new content in $file */
				file_put_contents($filePath,$newContent);
		return $message["ok"];
	}
	
