<?php

/** c'est un objet qui a une seule valeur: la base de donnée
*   La db est un tableau, array. La db = un objet*
*
*   Les différents niveaux
*   1 Webmaster - Il peut ajouter des membres - tout faire
*   2 Propriétaire - Il peut modifier les pages du blog!
*   3 Modérateur
*   4 Membre
*   5 Client
*/

class MembersManager extends Database{
        // Database table

  public function __construct()
  {
    parent::__construct();
  }

    // Création d'une ligne dans la base de donnée
    public function add(Member $member) {
		
		
		///////////////////////////////////////////////////
		// TRAVAUX EN COURS LE 25 MAI 2020 POUR Light //
		///////////////////////////////////////////////////
		/*
		echo '<p style="background-color: white; margin:20px;">';
		echo '<img style="margin-right:5px;height:30px;" src="img/smiley.png" alt="smiley au format png">Hey madame ou monsieur <strong>'.ucfirst($member->name()).'</strong> ! Bienvenue !';
		echo '<br>';
		echo "Vous êtes de <strong>niveau ".$member->level()."</strong>";
		echo '</p>';
		echo '<p style="background-color: lightblue; margin:20px;">
		<img style="margin:15px;" src="img/travaux.jpg" alt="travaux.jpg"><br>
		Travaux en code PHP en cours. <br>';
		echo '<hr>';
		echo 'var_dump($member); dans le fichier classes/MembersManager ligne 16: <br><br></p>
		<div style="margin:30px;">';
		var_dump($member);
		echo "</div>";
		echo '<p style="background-color: lightblue; margin:20px;">CONCLUSION : Php ne permet pas que l\'id soit null ici.<br>';
		
		echo '<hr>';
		
		echo '<h3>Local ou en ligne?</h3>';
        if(isset($_SERVER['SCRIPT_URI']))
			echo 'Nous sommes en ligne. <strong>Certaines données sensibles</strong> sont masquées. Aller en local pour voir ces données du fichier root/classes/MembersManager';
        else 
		{
		    echo 'Nous sommes en local. Des <strong>données sensibles</strong> inaccessibles en ligne sont affichées ici pour continuer à coder.'; 
		
			//  ACTIVER UNIQUEMENT POUR LE CODAGE EN LOCAL CAR CE CODE AFFICHE LE MOT DE PASSE
			echo '<hr>';
			echo '<h3>Réponse du formulaire rempli par le client :</h3>';
			echo '<h4>Avec un var_dump :</h4>';
			var_dump($_POST);
			
			echo '<h4>Avec un print_r :</h4>';
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
			
			echo '<h4>Avec un var_export :</h4>';
			echo '<pre>';
			var_export($_POST);
			echo '</pre>';
		}
		
		//die("<hr><br><br>Fin du var_dump.<br>die()</p>");
        */
		
		
    $q = $this->db->prepare('INSERT INTO ' . TABLE_MEMBER . '(name, password, level) VALUES( :name, :password, :level)');
    $q->bindValue(':name', $member->name());
    $q->bindValue(':password', $member->password());
    $q->bindValue(':level', $member->level());
    $q->execute();
    
    $member->hydrate([
      'id' => $this->db->lastInsertId(),
    ]);
  }
  
  // On compte les inscrits
  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM ' . TABLE_MEMBER . '')->fetchColumn();
  }
  
  // Lecture de la base de donnée pour voir si tel id ($info) y est
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel membernnage ayant pour id $info existe.
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM ' . TABLE_MEMBER . ' WHERE id = '.$info)->fetchColumn();
    }
    // Sinon, c'est qu'on veut vérifier que le name existe ou pas.
    $q = $this->db->prepare('SELECT COUNT(*) FROM ' . TABLE_MEMBER . ' WHERE name = :name');
    $q->execute([':name' => $info]);
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))// is_int: Get member attributs by "id"
    {
      $q = $this->db->query('SELECT * FROM ' . TABLE_MEMBER . ' WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      return new Member($donnees);
    }
    elseif(is_string($info)) // is_string: Get member attributs by "name" (string)
    {
		// echo "<div style=\"background-color:pink;padding:20px;\"><hr>";
		// echo __line__; echo " Classe MembersManager:<br>\$info = ";
		// print($info);
		// echo "<hr>";

        // On test d'abord si $info (nom d'un membre connecté) se trouve bien dans la base de données pour éviter un bug.		$info = "Phil";
		$requete = 'SELECT * FROM ' . TABLE_MEMBER . ' WHERE name = "' . $info . '"';
        $req = $this->db->prepare($requete);
        $req->execute();
        $datas = $req->fetch();
			// echo "<pre><hr>";
			// echo __line__; echo " Dans la classe MembersManager: \$datas vaut: ";
			// var_dump($datas);
			// echo "<pre><hr>";	
		
        if($datas == True){
			// echo __line__; echo "<pre>Dans la classe MembersManager: \$datas vaut: ";
			// print_r($datas);
			// echo "<pre><hr>";
			// exit("La classe Member a été instanciée avec $info");
			return new Member($datas);
		}
        else {
            unset($member); // The member do not exists in database but still in the navigator memory. We empty it.
            unset($_SESSION['member']); // same action to session memory
            session_destroy(); // close de session
        }
	}
	else {
            unset($member); // The member do not exists in database but still in the navigator memory. We empty it.
            unset($_SESSION['member']); // same action to session memory
            session_destroy(); // close de session
        };
  }
  
  public function getList($name)
  {
    $members = [];
    $q = $this->db->prepare('SELECT * FROM ' . TABLE_MEMBER . ' WHERE name <> :name ORDER BY name');
    $q->execute([':name' => $name]);
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $members[] = new Member($donnees);
    }
    
    return $members;
  }
  
  public function update(Member $member)
  {
    $q = $this->db->prepare('UPDATE member SET name = :name, password = :password, level = :level  WHERE id = :id');
    
    $q->bindValue(':id', $member->id(), PDO::PARAM_INT);
    $q->bindValue(':name', $member->name(), PDO::PARAM_STR);
    $q->bindValue(':password', $member->password(), PDO::PARAM_INT);
    $q->bindValue(':level', $member->level(), PDO::PARAM_INT);
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }
}