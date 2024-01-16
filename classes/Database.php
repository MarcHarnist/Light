<?php
/****        - CLASSE Database extends Methods extends Website  -
*                                 Marc L. Harnist
*                                   21/03/2018
*
*   Constantes et variables dans la classe Website
*   Aucune donnée ici. Uniquement des programmes.
*   UPDATED: 26/03/2018, 29/08/2018
*
*       METHODES
*   __construct()...................51
*
* CONNEXION TO DATABASE in __construct()
*  connect_to_database()..................line 71
*  connect_to_database_saving()...........line 95

* CREATE (C de CRUD)
*	create_table()..................75
*	create_in_table_budget_rules()..85
*
* READ (R de CRUD)
*   read_table()...................118  
*   budget_panorama()..............133  
*   budget_cde_panorama()..........161
*   budget_cheques()...............198
*   budget_cde_cheques()...........240
*   budget_echeancier()............282
*   budget_cde_echeancier()........319
*
* UPDATE (U de CRUD)
*   update_table_budget_cheques()..356 
*   last_entry()...................420
*   update_table_panorama()........414
*   update_table_cde_panorama()....494
*   update_table_echeancier() .....550
*   list_categories()..............610
*   getOnePageById($id = 1)........626
*   getPagesByCategories().........646
*   getOneEntryById()..............713
*   last_id()......................732
*   getOnePageByIdToUpdate().......747
*   update_table_members().........772
*   getOneClientById($id = 1)......
*   light_members()................824
*   update_table_rules()...........861
*   update_article()..............1028
*
* DELETE (D de CRUD)
*   delete().......................954
*   truncate().....................974
*
*   table_exists()................1160
*
*/
class Database extends Methods // extends Methods extends Website
{

	//ATTRIBUTS
    protected $db;
    private $db_host;                      // pour la classe "Database"
    private $db_name   = 'marcharnssmarc'; // pour la classe "Database"
    private $db_username;                  // pour la classe "Database"
    private $db_password;                  // pour la classe "Database"
	public $webmaster;
	private $tableStats = TABLE_STATS;

    /** Nom : __construct..........51
    *   Description : crée l'objet Database avec les identifiants définis dans config.php
    *   Paramètres : aucun
    *   Valeurs retournées : aucune. On crée des attributs dans l'objet avec les identifiants
    *                        renseignés dans les variables ci-dessus et on se connecte à la
    *                        base de donnée en appellant la fonction connect()
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 21/03/2018
    *   Modifiée le : 26/03/2018
    */
    public function __construct() // protected = reserved to children classes
    {
        parent::__construct();

		$this->db_host = DB_HOST;
		$this->db_username = DB_USER;
		$this->db_password = DB_PASSWORD;
		$this->webmaster = WEBMASTER;
		//To do: MH: create setter and getters to replace the four lines above

		// include_once("models/globals.php");

		
		$this->connect_to_database();//connect to database
    }
/** connect_to_database()..................line 77
*
*   Used in classes/Sql.php->download() line 94
*
*	Description : connexion à la base de donnée
*	Paramètres: identifiants de connexion "privés"
*	Valeurs retournées : objet PDO
*   Version : 1.0
*   Créée le : 21/03/2018
*   Modifiée le : 2019-02-02 ajout de try et catch
*/  protected function connect_to_database(){
	
		// echo $this->db_host . '; ' . $this->db_name . ', ' . $this->db_username . ', ' . $this->db_password;
	
        try {
			$this->db = new PDO('mysql:host=' . $this->db_host . '; dbname=' . $this->db_name, $this->db_username, $this->db_password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->db->exec("SET CHARACTER SET utf8");
		} catch(PDOException $e) {
			echo '<p>Note du webmaster ' . $this->webmaster . ': Erreur de connection à la base de donnée : ' . $e->getMessage() . '</p>';
			die("<p><i>Error message from " . __FILE__ . " / " . __LINE__ . "</i>");
		}
    }

/** connect_to_database_saving()..................line 93
*	Description : connexion à la base de donnée
*	Paramètres: identifiants de connexion "privés"
*	Valeurs retournées : objet PDO
*   Version : 1.0
*   Créée le : 21/03/2018
*   Modifiée le : 26/03/2018
*/  protected function connect_to_database_saving(){
		$conn = new PDO('mysql:host=' . $this->db_host . '; dbname=' . $this->db_name, $this->db_username, $this->db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
     return $conn;
    }
	
    /** Nom : create_table()
    *   Description : création d'une table
    *   Paramètres : nom de la table
	*   Paramètre par défaut: new_light_pages
    *   Valeurs retournées : String :message "$retour".
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 21/03/2018
    *   Modifiée le : 29/08/2018 déplacée ici
    */
	public function create_table($nom_de_la_table = 'new_light_pages')
	{
	    $retour = "Table créée avec succès.";
		$request = "CREATE TABLE IF NOT EXISTS ".$nom_de_la_table." (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `date` varchar(255) COLLATE utf8_bin NOT NULL,
		  `author` varchar(255) COLLATE utf8_bin NOT NULL,
		  `title` text COLLATE utf8_bin NOT NULL,
		  `text` text COLLATE utf8_bin NOT NULL,
		  `category` varchar(255) COLLATE utf8_bin NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='pour le projet Budget PHP POO '";
		
		//Lance la requète
		$this->db->query($request);

		//Vérifie qu'il n'y a pas eu d'erreur
		if(mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT) === false) 
			$retour = "Erreur dans la création de la table.";
		
		return $retour;
	}



/** Nom : create_in_table_budget_rules()
    *   Description : création d'une règle (budget)
    *   Paramètres : table, date, auteur, regle (rule)
    *   Valeurs retournées : aucune.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 21/03/2018
    *   Modifiée le : 29/08/2018 déplacée ici
    */
	public function create_in_table_budget_rules($table, $date, $auteur, $rule){
	  $req = $this->db->prepare('INSERT INTO ' . $table . ' (date, auteur, rule) VALUE(:date, :auteur, :rule)');
	  $req->execute(array(
						 'date' => $date,
						 'auteur' => $auteur,
						 'rule' => $rule,
						 ));
	}
    /**     READ TABLE
    *       2. READ = R from CRUD
    *
    *     Envoyer le nom d'une table entre parenthèse
    *     et cette méthode vous retourne un tableau (array())
    *     avec toutes les entrées du tableau (table en anglais)
    *     de la base de donnée.
    *
    *     Nom : read_table
    *     Paramètres: nom du tableau de la base de donnée (table)
    *     Valeurs retournées : [array]  array qui contient toutes les données de la table
    *     Version : 1.0
    *     Créée le : 06/04/2018
    *     Modifiée le : 06/04/2018
    */
      function read_table($table = TABLE_PAGES){
        $mysql_request = 'SELECT * FROM ' . $table . '';
        $stmt = $this->db->query($mysql_request); //stmt = preparing statement, état de préparation, convention de codeurs
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
    
    /** Nom : budget_panorama()
    *   Description : modifie le tableau budget_panorama
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 17/08/2018
    */
    public function budget_panorama($operation, $posts){

        // Déclaration des variables

        $save_pseudo = $name = $confirm = $id = "";
        $table = "budget_panorama";
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "date" => "", "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT date FROM budget_panorama WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "date" => $donnees['date'], "ancre" => $ancre];
        }
        return $database;
    }
    
    /** Nom : budget_cde_panorama()
    *   Description : modifie le tableau budget_panorama
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 21/08/2018
    *   Modifiée le : 21/08/2018
    */
    public function budget_cde_panorama($operation, $posts){

        // Déclaration des variables

        $save_pseudo = $name = $confirm = $id = "";
        $table = "budget_cde_panorama";
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "date" => "", "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT date FROM ".$table." WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "date" => $donnees['date'], "ancre" => $ancre];
        }
        return $database;
    }

    /** Nom : budget_cheques()
    *   Description : modifie le tableau budget_cheques
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 17/08/2018
    *   Utilisé dans controllers/budget-cde-cheques et
    *                controllers/budget-cheques.php
    */
    public function budget_cheques($operation, $posts){

        // Déclaration des variables

        $confirm = $id = $ordre = $montant = $date = "";
        $table = "budget_cheques";
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;
        if(isset($posts['ordre'])) $ordre = $posts['ordre'];
        if(isset($posts['montant'])) $montant = $posts['montant'];
        

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "date" => "", "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT date FROM budget_cheques WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "date" => $donnees['date'], "ancre" => $ancre, "montant" => $montant, "ordre" => $ordre];
        }
        return $database;
    }
    
    /** Nom : budget_cde_cheques()
    *   Description : modifie le tableau budget_cde_cheques
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 17/08/2018
    *   Utilisé dans controllers/budget-cde-cheques et
    *                controllers/budget-cheques.php
    */
    public function budget_cde_cheques($operation, $posts){

        // Déclaration des variables

        $confirm = $id = $ordre = $montant = $date = "";
        $table = "budget_cde_cheques";
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;
        if(isset($posts['ordre'])) $ordre = $posts['ordre'];
        if(isset($posts['montant'])) $montant = $posts['montant'];
        

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "date" => "", "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT * FROM ".$table." WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "date" => $donnees['date'], "ancre" => $ancre, "montant" => $donnees['montant'], "ordre" => $donnees['ordre']];
        }
        return $database;
    }
    
    /** Nom : budget_echeancier()
    *   Description : modifie le tableau budget_echeancier
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 20/08/2018
    */
    public function budget_echeancier($operation, $posts){

        // Déclaration des variables
        $table = "budget_echeancier";

        $confirm = $id = $acteur = $poste = "";
        $id = $posts['id'];
        //Paramètrage de l'ancre
        $ancre = $posts['ancre']-1;
        

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $posts['id'],
            ));
            $database = ["id" => $posts['id'], "poste" => $posts['poste'], "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT * FROM ".$table." WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "day" => $donnees['day'], "poste" => $donnees['poste'],  "ancre" => $ancre];
        }
        return $database;
    }
    
    /** Nom : budget_cde_echeancier()
    *   Description : modifie le tableau budget_cde_echeancier
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 20/08/2018
    */
    public function budget_cde_echeancier($operation, $posts){

        // Déclaration des variables
        $table = "budget_cde_echeancier";

        $confirm = $id = $acteur = $poste = "";
        $id = $posts['id'];
        //Paramètrage de l'ancre
        $ancre = $posts['ancre'];
        

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $posts['id'],
            ));
            $database = ["id" => $id, "poste" => $posts['poste'], "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT * FROM ".$table." WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "day" => $donnees['day'], "poste" => $donnees['poste'],  "ancre" => $ancre];
        }
        return $database;
    }
    
 /**  Methode "update_table_budget_cheques"
  *  Description : met à jour le tableau (table en anglais)
  *  Paramètres: nom du tableau (table), $rule_id, $date, $auteur, $rule, $id
  *  Valeurs retournées : boléen
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 16/08/2018
  */ public function update_table_budget_cheques($table, $posts){

        // Je récupère les données du formulaire
        $operation = $ancre = "";

        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            if($key == 'numero')
                $numero = $value;
            elseif($key == 'operation')
              $operation = $value;
            elseif($key == 'ancre')
              $ancre = $value-5;
            else
              $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, c'est qu'il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
        
        // UPDATING ?
        if($operation == "update"){
             $req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, numero = :numero, date = :date, acteur = :acteur, ordre = :ordre, montant = :montant, encaissement = :encaissement WHERE id = :id');
              $req->execute(array(
               'new_id' => $posts['new_id'],
               'numero' => $posts['numero'],
               'date' => $posts['date'],
               'acteur' => $posts['acteur'],
               'ordre' => $posts['ordre'],
               'montant' => $posts['montant'],
               'encaissement' => $posts['encaissement'],
               'id' => $posts['id'],
               ));
   
           return $ancre;
   
         }
        
        // CREATION ?
        if($operation == "creation" && $numero != ""){
             $req = $this->db->prepare('INSERT INTO ' . $table . '  (numero, date, acteur, ordre, montant, encaissement) VALUE(:numero, :date, :acteur, :ordre, :montant, :encaissement)');
              $req->execute(array(
               'numero' => $posts['numero'],
               'date' => $posts['date'],
               'acteur' => $posts['acteur'],
               'ordre' => $posts['ordre'],
               'montant' => $posts['montant'],
               'encaissement' => $posts['encaissement'],
                ));
                
           return $ancre;
        }  
    }

/*    Nom : last_entry
*     Last_entry = R from CRUD - Database Read
*     Valeurs retournées : array() avec toutes les données de la dernière entrée
*     Version : 1.0
*     Créée le : 15/08/2018
*     Modifiée le : 17/08/2018                                                    *
*     Utilisée dans: root/controllers/__budget-rapport.php
*     Utilisée dans: root/controllers/__budget-echeancier.php
*/    function last_entry($table = TABLE_PAGES){
        $read = $this->read_table($table);
        $last_entry = end($read);
        return $last_entry;
    }

  /**  Methode "update_table_panorama"
  *  Description : met à jour le tableau (table en anglais) "budget_panorama"
  *  Paramètres: nom du tableau (table), $posts =  $_POST
  *  Valeurs retournées : ancre (pour url de retour)
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 19/08/2018
  */ public function update_table_panorama($table, $posts){

        // Je récupère les données du formulaire
        $operation = $ancre = "";

        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            if($key == 'date')
                $date = $value;
            elseif($key == 'operation')
              $operation = $value;
            elseif($key == 'ancre')
              $ancre = $value-5;
            else
              $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, c'est qu'il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
        
        // UPDATING
        if($operation == "update"){
          $req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, date = :date, liquidite = :liquidite, epargne = :epargne, avenir = :avenir, credit = :credit WHERE id = :id');
          $req->execute(array(
           'new_id' => $posts['new_id'],
           'date' => $posts['date'],
           'liquidite' => $posts['liquidite'],
           'epargne' => $posts['epargne'],
           'avenir' => $posts['avenir'],
           'credit' => $posts['credit'],
           'id' => $posts['id'],
           ));
           return $ancre;
         }
        
        // CREATION
        if($operation == "creation"){
          $req = $this->db->prepare('INSERT INTO budget_panorama(date, liquidite, epargne, avenir, credit) VALUE(:date, :liquidite, :epargne, :avenir, :credit)');
          $req->execute(array(
            'date' => $posts['date'],
            'liquidite' => $posts['liquidite'],
            'epargne' => $posts['epargne'],
            'avenir' => $posts['avenir'],
            'credit' => $posts['credit'],
            ));
            
           return $ancre;
        }  
  }

  /** Method "update_table_RIASEC_questions"
  *   Description : update db table "riasec_questions"
  *   Parameters: db table name and $posts ($_POST)
  *   Returns : anchor (for url#anchor)
  *   Version : 1.0
  */ 
public function update_table_riasec_questions($table, $posts){
	$id =
	$question =
	$theme =
	$profile = 
	$operation =
	$ancre = "";

	foreach($posts as $key => $value)
	{
		//Return false if there are htmlspecialchars
		if($posts[$key] !== htmlspecialchars($posts[$key])) return false;

		switch($key){
			case "id":
			$id = $value;
			break;
			case "question":
			$question = $value;
			break;
			case "theme":
			$theme = $value;
			break;
			case "profile":
			$profile = $value;
			break;
			case "anchor":
			$anchor = $value-1;
			break;
			case "operation":
			$operation = $value;
			break;
		}
	}
	
	// CREATION
	switch($operation)
	{
		case "creation":
		$req = $this->db->prepare('INSERT INTO ' . $table . ' (question, theme, profile ) VALUE(:question, :theme, :profile)');
		$req->execute(array(
		'question' => $question,
		'theme' => $theme,
		'profile' => $profile,
		));
		return $ancre;
		break;
		case "update":
		$req = $this->db->prepare('UPDATE ' . $table . ' SET question = :question, theme = :theme, profile = :profile WHERE id = :id');
		$array = [
				'id' => $id,
				'question' => $question,
				'theme' => $theme,
				'profile' => $profile,
				];
		$req->execute($array);
		return $anchor;
		break;
		case "delete":
		$req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
		$req->execute(array('id' => $id));
		return $anchor;
		break;
	}
}
/** Method Riasec "update_table_stats"
*   Parameters: db table name and $posts ($_POST)
*   Returns : anchor (for url#anchor)
*/ 
public function update_table_stats($table = TABLE_STATS, $posts){

	$id =
	$name =
	$visits =
	$operation =
	$anchor = 0;
	$messageException = "Pas de problème dans la db";

	foreach($posts as $key => $value)
	{
		//Return false if there are htmlspecialchars
		if(strval($posts[$key]) !== htmlspecialchars($posts[$key]))
		{
			return false;
		}
		switch($key)
		{
			case "id":
			$id = $value;
			break;
			case "name":
			$name = $value;
			break;
			case "visits":
			$visits = $value;
			break;
			case "anchor":
			$anchor = $value-1;
			break;
			case "operation":
			$operation = $value;
			break;
		}
	}
	switch($operation)
	{
		// CREATION
		case "creation":
		$request = 'INSERT INTO ' . $table . ' (name, visits) VALUE(:name, :visits)';
		try
		{
			$req = $this->db->prepare($request);
			$req->execute(array(
			'name' => $name,
			'visits' => $visits,
			));
		}
		catch(Exception $e)
		{
			$messageException = $e->getMessage();
		}
		return ["messageException" => $messageException, "anchor"  => $anchor];
		break;
		
		//UPDATING
		case "update":
		$requestUpdate = 'UPDATE ' . $table . ' SET name = :name, visits = :visits WHERE id = :id';
		$updateArray = [
				'id' => $id,
				'name' => $name,
				'visits' => $visits,
				];
		try{
			$req = $this->db->prepare($requestUpdate);
			$req->execute($updateArray);
		}catch(Exception $e){
			$messageException = $e->getMessage();
		}
		return ["messageException" => $messageException, "anchor"  => $anchor];
		break;
		
		//DELETE
		case "delete":
		$req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
		$req->execute(array('id' => $id));
		return $anchor;
		break;
	}
}
/** Method Riasec "statsIncrementPage"
*   Parameters: page name : accueil or activité, or occupation, or compétences, or caractère or mail for Riasec 
*   Returns exception message if exists and anchor (for links in page html)
*/
public function statsIncrementPage(string $pageName)
{
	$tableStatsData = $this->read_table($this->tableStats);
	//Search page to update in db
	foreach($tableStatsData as $key => $val)
	{
		switch($val['name'])
		{
			case $pageName:
			$array1 = 
			[
				"id" => $val['id'],
				"name" => $val['name'],
				"visits" => $val['visits']+1,
				"operation" => "update",
				"anchor" => 0
			];
			return $this->update_table_stats($this->tableStats, $array1);
			break;
		}
	}
}
  /**  Methode "update_table_cde_panorama"
  *  Description : met à jour le tableau (table en anglais) "budget_panorama"
  *  Paramètres: nom du tableau (table), $posts =  $_POST
  *  Valeurs retournées : ancre (pour url de retour)
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 19/08/2018
  */ public function update_table_cde_panorama($table, $posts){

        // Je récupère les données du formulaire
        $operation = $ancre = "";

        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            if($key == 'date')
                $date = $value;
            elseif($key == 'operation')
              $operation = $value;
            elseif($key == 'ancre')
              $ancre = $value-5;
            else
              $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, c'est qu'il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
        
        // UPDATING
        if($operation == "update"){
          $req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, date = :date, liquidite = :liquidite, epargne = :epargne, avenir = :avenir WHERE id = :id');
          $req->execute(array(
           'new_id' => $posts['new_id'],
           'date' => $posts['date'],
           'liquidite' => $posts['liquidite'],
           'epargne' => $posts['epargne'],
           'avenir' => $posts['avenir'],
           'id' => $posts['id'],
           ));
         }
        
        // CREATION
        if($operation == "creation"){
          $req = $this->db->prepare('INSERT INTO '.$table.' (date, liquidite, epargne, avenir) VALUE(:date, :liquidite, :epargne, :avenir)');
          $req->execute(array(
            'date' => $posts['date'],
            'liquidite' => $posts['liquidite'],
            'epargne' => $posts['epargne'],
            'avenir' => $posts['avenir'],
            ));
        }  
        return $ancre;
  }

  /**  Methode "update_table_echeancier"
  *  Description : met à jour le tableau (table en anglais) "budget_echeancier"
  *  Paramètres: nom du tableau (table), $posts =  $_POST
  *  Valeurs retournées : ancre (pour url de retour)
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 20/08/2018
  */ public function update_table_echeancier($table, $posts){
        // Je récupère les données du formulaire
        $operation = $ancre = "";
        $id = $new_id = $day = $acteur = $poste = $montant_sem = $montant_mois = $montant_annee = 0; 

        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            if($key == 'date')
                $date = $value;
            elseif($key == 'operation')
              $operation = $value;
            elseif($key == 'ancre')
              $ancre = $value-5;
            else
              $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, c'est qu'il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
        // UPDATING
        if($operation == "update"){
          $req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, day = :day, acteur = :acteur, poste = :poste, montant_sem = :montant_sem, montant_mois = :montant_mois, montant_annee = :montant_annee WHERE id = :id');
          $req->execute(array(
           'new_id' => $posts['new_id'],
           'day' => $posts['day'],
           'acteur' => $posts['acteur'],
           'poste' => $posts['poste'],
           'montant_sem' => $posts['montant_sem'],
           'montant_mois' => $posts['montant_mois'],
           'montant_annee' => $posts['montant_annee'],
           'id' => $posts['id'],
           ));
         }
        
        // CREATION
        if($operation == "creation"){
          $req = $this->db->prepare('INSERT INTO ' . $table . '(day, acteur, poste, montant_sem, montant_mois, montant_annee) VALUE(:day, :acteur, :poste, :montant_sem, :montant_mois, :montant_annee)');
          $req->execute(array(
            'day' => $posts['day'],
            'acteur' => $posts['acteur'],
            'poste' => $posts['poste'],
            'montant_sem' => $posts['montant_sem'],
            'montant_mois' => $posts['montant_mois'],
            'montant_annee' => $posts['montant_annee'],
            ));
        }  
       return $ancre;
  }
    // 2. LIST CATEGORIES =  R from CRUD - Database Read
    /**
    *     Nom : list_categories
    *     Paramètres: aucun
    *     Valeurs retournées : [array]  array qui contient toutes les catégoies des pages
    *     Version : 1.0
    *     Créée le : 18/07/2018
    *     Modifiée le : 18/07/2018                                                    *
    *     Utilisée dans: root/controllers/pages-creations.php
    */

        function list_categories(){
            $read = $this->read_table();
            $list=[];
            foreach($read as $category){
				$list[] = $category['category'];
			}
            $categories = array_unique($list); // array_unique supprime les doublons dans un array!
            return $categories;
        }
    /** Nom : getOnePageById($id = 1)
    * Description : sélectionne une page par son "id"
    * Paramètres : int($id)
    * Valeurs retournées : array avec toutes les entrées de la page demandée
    * Version : 1.0
    * Créée le : 20/07/2018
    * Modifiée le : 20/07/2018
	* Used in: page-from-page-index,__page-delete
    */

        public function getOnePageById($id = 1){
            $req = $this->db->prepare('SELECT * FROM ' . TABLE_PAGES . ' WHERE id = ' . $id . '');
            $req->execute();
            $page = $req->fetch ();
            $page['title'] ? $this->cleanPageName($page['title']) : " No title "; // function in models/page.php
            $page['text'] ? nl2br($page['text']) : " ";
            $page['date'] ? date(('d/m/Y'),$page['date']) : '01/01/1970';
            return $page;
        }

    /**  Nom : getPagesByCategories
    * Description : sélectionne les pages de la table "light_pages" dans la bdd pour une catégorie.
    * Paramètres : categorie
    *                        page (page ou s'affiche les données: l'accueil veut la dernière
    *                        int: nombre de caractères pour les extraits
    *              entrée de l'array des données de la database. On choisit un ordre croissant)
    * [STRING] $category -> Nom de la catégorie: news, cours, tools, python, php...
    * Catégorie par défaut: news
    * Valeurs retournées : array avec toutes les entrées de la catégorie demandée
    *                      les données sont classées différemment selon qu'elles seront affichées
    *                      dans un lexique (ordre alphabétique ou des news: ordre chronologique)
    * Version : 1.0
    * Créée le : 06/03/2018
    * Modifiée le : 13/03/2018
    */
        function getPagesByCategories($category = "news", $page = "accueil", $int)
        {
            // The news are display from last to older
            if ($category == "news" && $page == ""){
                $sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY date DESC';
            }
            // The last news is called for the homepage
            elseif ($category == "news" && $page == "accueil"){
                $sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY id ASC';
            }
            // The last news is called for the homepage
            elseif ($category == "idees"){
                $sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY id DESC';
            }
            // The lexicon is displayed by alphabetical order from A to Z (title)
            elseif ($category == "lexicon"){
                $sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY title ASC';
            }else{
                $sql = 'SELECT * FROM ' . TABLE_PAGES . ' WHERE category = :category ORDER BY date ASC';
            }

                        // ATTENTION: respectez bien l'ordre des ' et des " N'oubliez pas non plus les . (concaténation)
                        // $mysql_request = 'SELECT * FROM ' . $table . '';

                        // Mysql request ($stmt = preparing statement = état de préparation = une convention de codeurs)
                        // $stmt = $this->db->query($mysql_request);
                        // $lire = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sth = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute(array(':category' => $category));
            $this->pages_by_category = $sth->fetchAll();

            // On effectue du traitement sur les données (contrôleur)
            // Ici, on doit surtout sécuriser l'affichage

                // Si le texte entier est plus long que l'extrait on rajoute un lien pour lire tout
                // if($this->page_en_cours_de_lecture['extrait'] !== $this->page_en_cours_de_lecture['original']) $this->page_en_cours_de_lecture['link'] = true;
            foreach($this->pages_by_category as $this->clef => $this->page_en_cours_de_lecture) {
                $this->pages_by_category[$this->clef]['title'] = $this->page_en_cours_de_lecture['title'];
                $this->pages_by_category[$this->clef]['texte_entier'] = nl2br($this->page_en_cours_de_lecture['text']);
                $this->pages_by_category[$this->clef]['original'] = $this->pages_by_category[$this->clef]['texte_entier'];
                $texte_entier = $this->page_en_cours_de_lecture['text'];
                $this->pages_by_category[$this->clef]['extrait'] = substr($this->pages_by_category[$this->clef]['texte_entier'], 0, $int);
                $this->pages_by_category[$this->clef]['link'] = False;
                if(strlen($this->pages_by_category[$this->clef]['extrait']) < strlen($this->pages_by_category[$this->clef]['original'])) $this->pages_by_category[$this->clef]['link'] = True;
                $this->pages_by_category[$this->clef]['date'] = date(('d/m/Y'), $this->pages_by_category[$this->clef]['date']);
                $this->pages_by_category[$this->clef]['category'] = $this->cleanUrl($this->page_en_cours_de_lecture['category']);// function in models/clean-url.php
                $this->pages_by_category[$this->clef]['category'] = $this->cleanUrl($this->page_en_cours_de_lecture['category']);// function in models/clean-url.php
                $this->pages_by_category[$this->clef]['url'] = $this->cleanUrl($this->page_en_cours_de_lecture['title']);// function in models/clean-url.php
            }
            if($page == 'accueil') $this->pages_by_category = $this->pages_by_category[(count($this->pages_by_category) -1)];
            return $this->pages_by_category;
        }
    /** Nom : getOneEntryById
    * Description : sélectionne une entrée d'un tableau par son "id"
    * Paramètres : int($id)
    * Valeurs retournées : array avec l'entrée demandée
    * Version : 1.0
    * Créée le : 16/08/2018
    * Modifiée le : 16/08/2018
    */

        public function getOneEntryById($table = "", $id){
          if($table != "" && $id != ""){

            $req = $this->db->prepare('SELECT * FROM ' . $table . ' WHERE id = ' . $id . '');
            $req->execute();
            $entry = $req->fetch ();
            return $entry;
          }
          return False;
        }
    // 2. Last_id = R from CRUD - Database Read
    /*    Nom : last_id
    *     Paramètres: id
    *     Valeurs retournées : string avec dernier id créé toutes catégories confondues
    *     Version : 1.0
    *     Créée le : 18/07/2018
    *     Modifiée le : 18/07/2018                                                    *
    *     Utilisée dans: root/controllers/pages-creations.php
    */

        function last_id(){
            $read = $this->read_table();
            $last_entry = end($read);
            return $last_entry['id'];
        }
	
        function getLastId($table){
            $read = $this->read_table($table);
            $last_entry = end($read);
            return $last_entry['id'];
        }
	

    /** Nom : sqlRequest
    * Description : select one page by "id"
    * Creation : 2020-08-06
    */  
	function sqlRequest($id)
	{
		$req = $this->db->prepare('SELECT * FROM ' . TABLE_PAGES . ' WHERE id = ' . $id . '');
		$req->execute();
		$page = $req->fetch ();
		return $page;
	}
    /** Nom : tryToFindNextId
    * Description : search next id if exists
    * Version : 1.0
    * Creation : 2020-08-06
    * Version : 1.0
    */  
	function tryToFindNextId($id)
	{
		$maxResearch = 1000;//Must be enough
		for($i=0;$i<$maxResearch; $i++)
		{	
			$nextId = $id+$i;
			$page = $this->sqlRequest($nextId);
			if($page !== False) return $page;
		}
		return $page;
	}
    /** Nom : getOnePageByIdToUpdate
    * Description : sélectionne une page par son "id" -------- sans nl2br ----------------
    * Version : 1.0
    * Créée le : 20/07/2018
    * Modifiée le : 20/07/2018
    */  
    public function getOnePageByIdToUpdate($id = null)
	{
		if($id !== null)
		{
			$page = $this->sqlRequest($id);
			if($page === False)
			{
				//Id changed by delete other pages
				$page = $this->tryToFindNextId($id);
			}
			if($page === False) return false;
			
			if(isset($page['date']))
			{
				$page['date'] = date(('d/m/Y'),$page['date']);
			}

			//Title for the head
			if(isset($page['title']))
			{
				$page['title'] = $this->cleanPageName($page['title']); 
				// function in classes/Methods.php
			}
			if($page !== False) return $page;
			else return false;
		}
		return false;
    }
 /**  Methode "update_table_members"
  *  Description : met à jour le tableau (table en anglais)
  *  Paramètres: nom du tableau (table), $id,$name, $level
  *  Valeurs retournées : boléen
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 28/08/2018
  */ public function update_table_members($table, $posts){

        // Je récupère les données du formulaire
        $operation = $ancre = "";

        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            if($key == 'operation')
              $operation = $value;
            elseif($key == 'ancre')
              $ancre = $value-5;
            else
              $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, c'est qu'il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
        
        // UPDATING
        if($operation == "update"){
          $req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, name = :name, level = :level WHERE id = :id');
          $req->execute(array(
           'new_id' => $posts['new_id'],
           'name' => $posts['name'],
           'level' => $posts['level'],
           'id' => $posts['id'],
           ));
           return $ancre;
         }
        
        // CREATION
        if($operation == "creation"){
          $req = $this->db->prepare('INSERT INTO ' . $table . ' (name, password, level) VALUE(:name, :password, :level)');
          $req->execute(array(
           'name' => $posts['name'],
           'password' => $posts['password'],
           'level' => $posts['level'],
            ));
           return $ancre;
        }  

    }
    /** Nom : getOneClientById($id = 1)
    * Description : sélectionne un client par son "id"
    * Paramètres : int($id)
    * Valeurs retournées : array avec toutes les entrées du client demandé
    * Version : 1.0
    * Créée le : 20/07/2018
    * Modifiée le : 03/06/2020
	* Used in: client-index
    */

        public function getOneClientById(int $id)//int $id : doit être un nombre, sinon ça bloque ici
	{
	    
	    $client = array();
	    //Vérifie si la table de la db et l'id ne sont pas nuls
	    if(null !== TABLE_CLIENT && null !== $id)
	    {
		    //Définit la requête sql
		    $req = $this->db->prepare('SELECT * FROM ' . TABLE_CLIENT . ' WHERE id = ' . $id . '');

                    //Execute la requète
		    $req->execute();
           
                    //Cherche (fetch) la réponse et l'enregistre dans $client
		    $client = $req->fetch ();
            }
            return $client;
        }


  /**  Methode "update_table_clients"
  *  Description : met à jour le tableau (table en anglais)
  *  Paramètres: nom du tableau (table), $id, $civilite, $name, $level
  *  Valeurs retournées : boléen
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 28/08/2018
  */ public function update_table_clients($table, $posts){

        // Je récupère les données du formulaire
		$resultat = false;

		//Pour chaque valeur du tableau $posts, on applique un traitement
        foreach($posts as $key => $value){
            $post_saved = $posts[$key];//Besoin pour contrôle htmlspecialchars
            $posts[$key] = htmlspecialchars($value);

            //Vérification si la valeur a changé.
            if($post_saved != $posts[$key])
                //Si oui, si différents, il y a du code html. On bloque tout.
                exit("Blocage: il y a du code html dans votre saisie...");
        }
		/*
		Id - id
		Civilité - civilite
		Nom - name
		Prénom - firstname
		Email - email 
		Mot de passe - password
		Téléphone - phone
		Niveau - level
		*/
		
		//Sécurité: Vérification qu'il ne manque pas de donnée
		if(isset($posts['new_id']) && isset($posts['civilite']) && isset($posts['name']) && isset($posts['level']) && isset($posts['id']))
		{

			// UPDATING
			$req = $this->db->prepare('UPDATE ' . $table . ' SET id = :new_id, civilite = :civilite, name = :name, firstname = :firstname, email = :email,  password = :password, phone = :phone, level = :level WHERE id = :id');
			$req->execute(array(
			 'new_id' => $posts['new_id'],
			 'civilite' => $posts['civilite'],
			 'name' => $posts['name'],
			 'firstname' => $posts['firstname'],
			 'email' => $posts['email'],
			 'password' => $posts['password'],
			 'phone' => $posts['phone'],
			 'level' => $posts['level'],
			 'id' => $posts['id'],
			 ));
			 $resultat = true;
		}
		else
		{
			exit("Il manque une donnée dans le formulaire par rapport au nombre de données de la base de donnée. (Message d'erreur de la classe Database,  ligne 848.)");
		}
	   return $resultat;
    }
    /** Nom : light_members()
    *   Description : modifie le tableau light_members
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 03/06/2020
    */
    public function light_members($operation, $posts){

        // Déclaration des variables

        $save_pseudo = $name = $confirm = $id = "";
        $table = "light_members";
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT name FROM `".$table."` WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "ancre" => $ancre, "name" => $donnees['name']];
        }
        return $database;
    }

    /** Nom : light_clients()
    *   Description : modifie le tableau light_clients
    *   Paramètres : operation et $_POST
    *   Valeurs retournées : $ancre pour url de retour.
    *   Auteur : Marc L. Harnist
    *   Version : 1.0
    *   Créée le : 17/08/2018
    *   Modifiée le : 28/08/2018
    */
    public function light_clients($operation, $posts){

        // Déclaration des variables

        $save_pseudo = $name = $confirm = $id = "";
        $table = $this::TABLE_CLIENT;
        if(isset($posts['id'])) $id = $posts['id'];

        //Paramètrage de l'ancre
        if(isset($posts['ancre'])) $ancre = $posts['ancre']-7;

        if($operation == "delete"){
            // Requète sql
            $req = $this->db->prepare("DELETE FROM `".$table."` WHERE id = :id");
            $req->execute(array(
            'id' => $id,
            ));
            $database = ["id" => $id, "ancre" => $ancre];
        }

        if($operation == "select"){
            $reponse = $this->db->query("SELECT name FROM `".$table."` WHERE id=$id");
            $donnees = $reponse->fetch();
            $database = ["id" => $id, "ancre" => $ancre, "name" => $donnees['name']];
        }
        return $database;
    }

  /**  Methode "update_table_rules"
  *  Description : met à jour le tableau (table en anglais)
  *  Paramètres: nom du tableau (table), $rule_id, $date, $auteur, $rule, $id
  *  Valeurs retournées : boléen
  *  Auteur : Marc L. Harnist
  *  Version : 1.0
  *  Créée le : 16/08/2018
  *  Modifiée le : 16/08/2018
  */ public function update_table_rules($table, $rule_id, $date, $auteur, $rule, $id){
       $req = $this->db->prepare('UPDATE `' . $table . '` SET id = :rule_id, date = :date, auteur = :auteur, rule = :rule WHERE id = :id');
       $req->execute(array(
      'rule_id' => $rule_id,
      'date' => $date,
      'auteur' => $auteur,
      'rule' => $rule,
      'id' => $id,
       ));
       return True;
     }
/**  Methode "update_article()"
*  Description : met à jour le tableau (table en anglais)
*  Paramètres: $_POST en $post
*  Valeurs retournées : boléen
*  Auteur : Marc L. Harnist
*  Version : 1.0
*  Créée le : 16/08/2018
*  Modifiée le : 16/08/2018
*/	 
public function update_article($post)
{
	// On récupère les données d'un formulaire
	foreach($post as $label => $value)
	{
        //Traitement du formulaire dans une boucle!
		if($label != "text") // Si ce n'est pas du texte on efface les caractères html
			$post[$label] = htmlspecialchars($value);
		else
			$post[$label] = $value; // C'est du texte: on conserve la syntaxe html
	}
	$post['text'] = $this->cleanDoubleBr($post['text']); // replace double break by one only
	if(strstr($post['text'],'<?php') or strstr($post['text'], '<?PHP'))
		exit('<p>Il y a <\?php ou <\?PHP dans votre texte. Cela fait buger l\'affichage. Rajoutez des espaces: < ? php.</p>'); // S'il y a du code PHP dans le texte on bloque tout.
	$post['title'] = ucfirst($post['title']);
	if($post['category_new'] != '') $post['category'] = $post['category_new'];
	$post['category'] = $this->cleanUrl($post['category']);

	// Date
	if($post['date'] == '') {
		$this->error_date = 'empty';
		return False;}
	elseif(!preg_match( '`(\d{1,2})/(\d{1,2})/(\d{4})`' , $post['date'])) {
		$this->error_date = 'format';
		return False;}
	else {
		$post['date'] = str_replace('/','-',$post['date']);// replace / to - for strtotime
		$post['date'] = strtotime($post['date'], time());// turn date to timestamp
	}
	//Title verify
	if($post['title'] == '')
	{
		$this->error_title = 'empty';
		return False;
	}
	
	
	$this->author     =  $post['author'];
	$this->date       =  $post['date'];
	$this->title      =  $post['title'];
	$this->text       = $this->cleanDoubleBr($post['text']); // replace double break by one only
	$this->category   =  $post['category'];
	if(isset($post['last_id'])) $this->last_id = $post['last_id'];
	$this->operation  =  $post['operation'];
	if($this->operation  == 'update'){
		$this->page_id    =  $post['page_id']; //bizarre... (change id?)
		$this->N°         =  $post['N°'];
	}
	// CREATIONS
	if($post['operation'] == "creation")
	{
		$this->N° = $this->last_id+1;//N° = new id for page redirection at the bottom or the file pages-save.php
		$req = $this->db->prepare('INSERT INTO '. TABLE_PAGES .'(date, author, title, text, category) VALUE(:date, :author, :title, :text, :category)');
		$req->execute(array(
							 'date' => $this->date,
							 'author' => $this->author,
							 'title' => $this->title,
							 'text' => $this->text,
							 'category' => $this->category,
							 ));
	}
	elseif($post['operation'] == "update"){
		$req = $this->db->prepare('UPDATE ' . TABLE_PAGES . ' SET id = :page_id, date = :date, author = :author, title = :title, text = :text, category = :category WHERE id = :id');
		$req->execute(array(
		 'page_id' => $this->page_id,
		 'date' => $this->date,
		 'author' => $this->author,
		 'title' => $this->title,
		 'text' => $this->text,
		 'category' => $this->category,
		 'id' => $this->N°,
		 ));
	}
	return True; // Tout s'est bien passé. Note: Pas de données retournées: L'objet est créé simplement. On accède à ses attributs via accesseurs (getters en anglais) dans les controller et les vues.
}

/**  Methode "update_news()"
*  Description : met à jour le tableau (table en anglais)
*  Paramètres: $_POST en $post
*  Valeurs retournées : boléen
*  Auteur : Marc L. Harnist
*  Version : 1.0
*  Créée le : 12/06/2020
*  Modifiée le : 
*/	 
public function update_news($post = array(), $table = "test"){
	// On récupère les données d'un formulaire
	foreach($post as $label => $value){
        //Traitement du formulaire dans une boucle!
		if($label != "text") // Si ce n'est pas du texte on efface les caractères html
			$post[$label] = htmlspecialchars($value);
		else
			$post[$label] = $value; // C'est du texte: on conserve la syntaxe html
	}
	if(strstr($post['text'],'<?php') or strstr($post['text'], '<?PHP'))
		exit('<p>Il y a <\?php ou <\?PHP dans votre texte. Cela fait buger l\'affichage. Rajoutez des espaces: < ? php.</p>'); // S'il y a du code PHP dans le texte on bloque tout.
	$post['title'] = ucfirst($post['title']);
	if($post['category_new'] != '') $post['category'] = $post['category_new'];
	$post['category'] = $this->cleanUrl($post['category']);

	//Verify title not empty, date 
	if($post['title'] == '')
	{
		$this->error_title = 'empty';
		return False;
	}
	if($post['date'] == '')
	{
		$this->error_date = 'empty';
		return False;
	}
	elseif(!preg_match( '`(\d{1,2})/(\d{1,2})/(\d{4})`' , $post['date'])) 
	{
		$this->error_date = 'format';
		return False;
	}
	else {
		$post['date'] = str_replace('/','-',$post['date']);// replace / to - for strtotime
		$post['date'] = strtotime($post['date'], time());// turn date to timestamp
	}
	$this->author     =  $post['author'];
	$this->date       =  $post['date'];
	$this->title      =  $post['title'];
	$this->text       = $this->cleanDoubleBr($post['text']); // replace double break by one only
	$this->category   =  $post['category'];
	if(isset($post['last_id'])) $this->last_id = $post['last_id'];
	$this->operation  =  $post['operation'];
	if($this->operation  == 'update'){
		$this->page_id    =  $post['page_id']; //bizarre... (change id?)
		$this->N°         =  $post['N°'];
	}
	// CREATIONS
	if($post['operation'] == "creation"){
		$req = $this->db->prepare('INSERT INTO '. $table .'(date, author, title, text, category) VALUE(:date, :author, :title, :text, :category)');
		$req->execute(array(
							 'date' => $this->date,
							 'author' => $this->author,
							 'title' => $this->title,
							 'text' => $this->text,
							 'category' => $this->category,
							 ));
	}
	elseif($post['operation'] == "update"){
		$req = $this->db->prepare('UPDATE ' . $table . ' SET id = :page_id, date = :date, author = :author, title = :title, text = :text, category = :category WHERE id = :id');
		$req->execute(array(
		 'page_id' => $this->page_id,
		 'date' => $this->date,
		 'author' => $this->author,
		 'title' => $this->title,
		 'text' => $this->text,
		 'category' => $this->category,
		 'id' => $this->N°,
		 ));
	}
	return True; // Tout s'est bien passé. Note: Pas de données retournées: L'objet est créé simplement. On accède à ses attributs via accesseurs (getters en anglais) dans les controller et les vues.
}
	 
// 4. DELETE
// D from CRUD - Database Delete

/* Nom : delete
* Description : supprime une ligne de la base de donnée
* Paramètres : [int] id de la page à supprimer
*              [strint] $table: tableau à modifier. Par défaut: pages
* Valeurs retournées :  True si tout s'est bien passé
* Auteur : Marc L. Harnist
* Version : 1.0
* Créée le : 28/03/2018
* Modifiée le : 29/08/2018  
*/
function delete($id, $table = TABLE_PAGES){
	$req = $this->db->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
	$req->execute(array('id' => $id));
	return True;
}   

/** Nom : truncate()
*   Description : vide la table en cours
*   Auteur : Marc L. Harnist à La Rochelle
*   Version : 1.0
*   Créée le : 28/03/2018
****************************************/  
function truncate(){
	// ATTENTION: respectez bien l'ordre des ' et des " N'oubliez pas non plus les . (concaténation)
	$mysql_request = 'DELETE FROM ' . $this->table . '';

	// Mysql request ($stmt = preparing statement = état de préparation = une convention de codeurs)
	$stmt = $this->db->query($mysql_request);
}

/** Nom : drop_table()
*   Description : supprime la table en cours
*   Auteur : Marc L. Harnist
*   Version : 1.0
*   Créée le : 08/06/2020
****************************************/  
function drop_table($table_name){
	// ATTENTION: respectez bien l'ordre des ' et des " N'oubliez pas non plus les . (concaténation)
	$retour = "";
	$mysql_request = 'DROP TABLE IF EXISTS '.$table_name;

	// Mysql request ($stmt = preparing statement = état de préparation = une convention de codeurs)
	$stmt = $this->db->query($mysql_request);

	if(mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT) === true) 
		$retour .= "<p>Table supprimée avec succès.</p>";
	else
		$retour .= "<p>Erreur dans la suppression de la table.</p>";
	return $retour;
}

/** Nom : table_exists()
*   Description : vérifie si une table existe
*   Idée : éviter d'écraser une table
*   Auteur : Marc L. Harnist
*   Version : 1.0
*   Créée le : 12/06/2020
****************************************/ 
public function table_exists($table = 'table'){
	
	//Retour faux par défaut
	$retour = true;

	/** Test if this name exist in dba_close
	*
	*/
	try
	{
		$test = $this->db->query("SELECT 1 FROM $table LIMIT 1");
		$retour = true;
	} catch (Exception $e) 
	{
		// We got an exception == table not found
		$retour = false;
	}
	return $retour;
}

//Getters.........................................81
protected function get_db_host(){return $this->db_host;}
protected function get_db_name(){return $this->db_name;}
public function getDb(){ return $this->db;}

} // close the class

