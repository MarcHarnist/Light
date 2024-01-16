<?php
/** Class UserManager
*   Save object User in db
*/
class UserManager extends Database{

    public function __construct()
    {
        parent::__construct();
    }

	//Add a line in db riasec_users
	public function add(User $user)
	{
		try
		{
			$q = $this->db->prepare('INSERT INTO ' . TABLE_USERS . '(civilite, firstname, name, email) VALUES( :civilite, :firstname, :name, :email)');
			$q->bindValue(':civilite', $user->getCivilite());
			$q->bindValue(':firstname', $user->getFirstname());
			$q->bindValue(':name', $user->getName());
			$q->bindValue(':email', $user->getEmail());
			$q->execute();
		}
		catch(Exception $e)
		{
			return $e->getMessage();
		}
		$database = new Database;
        $user->hydrate([
            'id' => $database->getLastId(TABLE_USERS),
        ]);
		return True;
    }
    
    // On compte les inscrits
    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM ' . TABLE_USERS . '')->fetchColumn();
    }
    
    // Lecture de la base de donnée pour voir si tel id ($info) y est
    public function exists($info)
    {
        if (is_int($info)) // On veut voir si tel usernnage ayant pour id $info existe.
        {
            return (bool) $this->db->query('SELECT COUNT(*) FROM ' . TABLE_USERS . ' WHERE id = '.$info)->fetchColumn();
        }
        // Sinon, c'est qu'on veut vérifier que le name existe ou pas.
        $q = $this->db->prepare('SELECT COUNT(*) FROM ' . TABLE_USERS . ' WHERE name = :name');
        $q->execute([':name' => $info]);
        return (bool) $q->fetchColumn();
    }
    
    public function get($info)
    {
        if (is_int($info))// is_int: Get user attributs by "id"
        {
            $q = $this->db->query('SELECT * FROM ' . TABLE_USERS . ' WHERE id = '.$info);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            return new User($donnees);
        }
        elseif(is_string($info)) // is_string: Get user attributs by "name" (string)
        {
			// On test d'abord si $info (nom d'un membre connecté) se trouve bien dans la base de données pour éviter un bug.		$info = "Phil";
			$requete = 'SELECT * FROM ' . TABLE_USERS . ' WHERE name = "' . $info . '"';
			$req = $this->db->prepare($requete);
			$req->execute();
			$datas = $req->fetch();

			if($datas == True){
			return new User($datas);
			}
			else
			{
				unset($user); // The user do not exists in database but still in the navigator memory. We empty it.
				unset($_SESSION['user']); // same action to session memory
				session_destroy(); // close de session
			}
		}
		else 
		{
				// The user do not exists in db but still in the navigator memory. We empty it.
				unset($user);
				unset($_SESSION['user']); // same action to session memory
				session_destroy(); // close de session
		};
    }
    
    public function getList($name)
    {
        $users = [];
        $q = $this->db->prepare('SELECT * FROM ' . TABLE_USERS . ' WHERE name <> :name ORDER BY name');
        $q->execute([':name' => $name]);
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $users[] = new User($donnees);
        }
        
        return $users;
    }
    
    public function update(User $user)
    {
        $q = $this->db->prepare('UPDATE user SET name = :name, password = :password, level = :level    WHERE id = :id');
        
        $q->bindValue(':id', $user->id(), PDO::PARAM_INT);
        $q->bindValue(':name', $user->name(), PDO::PARAM_STR);
        $q->bindValue(':password', $user->password(), PDO::PARAM_INT);
        $q->bindValue(':level', $user->level(), PDO::PARAM_INT);
        $q->execute();
    }
    
    public function setDb(PDO $db)
    {
        $this->db = $db;
    }
}
