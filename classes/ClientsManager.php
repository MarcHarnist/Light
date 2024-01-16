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

class ClientsManager extends Database{
        // Database table

  public function __construct()
  {
    parent::__construct();
  }

    // Création d'une ligne dans la base de donnée
    public function add(Client $client) {
	
    $q = $this->db->prepare('INSERT INTO ' . TABLE_CLIENT . '(civilite, name, firstname, email, password, phone, level) VALUES(:civilite, :name, :firstname, :email, :password, :phone, :level)');
    $q->bindValue(':civilite', $client->civilite());
    $q->bindValue(':name', $client->name());
    $q->bindValue(':firstname', $client->firstName());
    $q->bindValue(':email', $client->email());
    $q->bindValue(':password', $client->password());
    $q->bindValue(':phone', $client->phone());
    $q->bindValue(':level', $client->level());
    $q->execute();
    
    $client->hydrate([
      'id' => $this->db->lastInsertId(),
    ]);
  }
  
  // On compte les inscrits
  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM ' . TABLE_CLIENT . '')->fetchColumn();
  }
  
  // Lecture de la base de donnée pour voir si un élément s'y trouve ($info = id ou nom)
  public function exists($info)
  {
	//Si l'info est un nombre
    if (is_int($info)) // On veut voir si l'élément avec cet id existe dans la db
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM ' . TABLE_CLIENT . ' WHERE id = '.$info)->fetchColumn();
    }
    // Sinon, c'est qu'on veut vérifier que le name existe ou pas.
    $q = $this->db->prepare('SELECT COUNT(*) FROM ' . TABLE_CLIENT . ' WHERE name = :name');
    $q->execute([':name' => $info]);
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))// is_int: Get client attributs by "id"
    {
      $q = $this->db->query('SELECT * FROM ' . TABLE_CLIENT . ' WHERE id = '.$info);
      $donnees = $q->fetch(PDO::FETCH_ASSOC);
      return new Client($donnees);
    }
    elseif(is_string($info)) // is_string: Get client attributs by "name" (string)
    {
		// echo "<div style=\"background-color:pink;padding:20px;\"><hr>";
		// echo __line__; echo " Classe ClientsManager:<br>\$info = ";
		// print($info);
		// echo "<hr>";

        // On test d'abord si $info (nom d'un membre connecté) se trouve bien dans la base de données pour éviter un bug.		$info = "Phil";
		$requete = 'SELECT * FROM ' . TABLE_CLIENT . ' WHERE name = "' . $info . '"';
        $req = $this->db->prepare($requete);
        $req->execute();
        $datas = $req->fetch();
			// echo "<pre><hr>";
			// echo __line__; echo " Dans la classe ClientsManager: \$datas vaut: ";
			// var_dump($datas);
			// echo "<pre><hr>";	
		
        if($datas == True){
			// echo __line__; echo "<pre>Dans la classe ClientsManager: \$datas vaut: ";
			// print_r($datas);
			// echo "<pre><hr>";
			// exit("La classe Client a été instanciée avec $info");
			return new Client($datas);
		}
        else {
            unset($client); // The client do not exists in database but still in the navigator memory. We empty it.
            unset($_SESSION['client']); // same action to session memory
            session_destroy(); // close de session
        }
	}
	else {
            unset($client); // The client do not exists in database but still in the navigator memory. We empty it.
            unset($_SESSION['client']); // same action to session memory
            session_destroy(); // close de session
        };
  }
  
  public function getList($name)
  {
    $clients = [];
    $q = $this->db->prepare('SELECT * FROM ' . TABLE_CLIENT . ' WHERE name <> :name ORDER BY name');
    $q->execute([':name' => $name]);
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $clients[] = new Client($donnees);
    }
    
    return $clients;
  }
  
  public function update(Client $client)
  {
    $q = $this->db->prepare('UPDATE client SET civilite = :civilite, name = :name, password = :password, level = :level  WHERE id = :id');
    
    $q->bindValue(':id', $client->id(), PDO::PARAM_INT);
    $q->bindValue(':civilite', $client->civilite(), PDO::PARAM_STR);
    $q->bindValue(':name', $client->name(), PDO::PARAM_STR);
    $q->bindValue(':password', $client->password(), PDO::PARAM_INT);
    $q->bindValue(':level', $client->level(), PDO::PARAM_INT);
    $q->execute();
  }
  
  public function setDb(PDO $db)
  {
    $this->db = $db;
  }
}