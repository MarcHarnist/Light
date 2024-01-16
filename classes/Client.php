<?php
/* by OpenClassRoom 2017
*
*   Les différents niveaux
*   1 Webmaster - Il peut ajouter des membres - tout faire
*   2 Propriétaire - Il peut modifier les pages du blog!
*   3 Modérateur
*   4 Membre
*   5 Client
*
*/
class Client {
  private $_id,
		  $_civilite,
          $_name,
          $_firstName,
          $_email,
          $_password,
          $_phone,
		  $_level,
		  $_capcha,
		  $_capchaReponse;
  public  $level;

  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
	$this->level = $this->_level;
  }
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);// if key = id, $method = setId;
      
      if (method_exists($this, $method)) // si la methode existe elle
                // est appellée    pour controler la valeur...
      {
        $this->$method($value);
      }
    }
  
    foreach ($donnees as $key => $value)
    {
      $method = 'add'.ucfirst($key);// if key = id, $method = setId;
      
      if (method_exists($this, $method)) // si la methode existe elle
                // est appellée    pour controler la valeur...
      {
        $this->$method($value);
      }
    }
  }
  
  // GETTERS //
  public function id()
  {
    return $this->_id;
  }
  public function civilite()
  {
    return $this->_civilite;
  }
  public function name()
  {
    return $this->_name;
  } 
  public function firstName()
  {
    return $this->_firstName;
  } 
  public function email()
  {
    return $this->_email;
  } 
  public function password()
  {
    return $this->_password;
  }
  public function phone()
  {
    return $this->_phone;
  }
  public function level()
  {
	  return $this->_level;
  }
    public function capcha()
  {
	  return $this->_capcha;
  }
    public function capchaReponse()
  {
	  return $this->_capchaReponse;
  }
  
  // Rajout de Marc H. 05/08/17 avec fierté !
  public function civiliteValide() // Input "civilite" cannot be empty
  {
	return !empty($this->_civilite); // empty: the var exists but is empty.
  }
  public function nameValide() // Input name cannot be empty
  {
	return !empty($this->_name); // empty: the var exists but is empty.
  }
  public function passwordValide() // Input name cannot be empty
  {
	return !empty($this->_password); // empty: the var exists but is empty.
  }
  
  //Retourne true si les deux capchas sont identiques, sinon, retourne false
  public function capchaValide()
  {
	//Donne une valeur par défaut au retour
	$retour = false;
	
	//Vérifie que les capchas ne sont pas nuls
	if($this->_capcha != null && $this->_capchaReponse != null)
	{
		//Compare les deux nombres des capchas
		if($this->_capcha == $this->_capchaReponse)
			//Défini le retour comme vrai.
			$retour = true;
	}
	return $retour;
  }
  
  public function setId($id)
  {
    $id = (int) $id;
    
    if ($id > 0)
    {
      $this->_id = $id;
    }
  }
  public function setCivilite($civilite)
  {
    if (is_string($civilite))
    {
      $this->_civilite = $civilite;
    }
  }
  public function setName($name)
  {
    if (is_string($name))
    {
      $this->_name = $name;
    }
  }
  public function setFirstName($firstName)
  {
    if (is_string($firstName))
    {
      $this->_firstName = $firstName;
    }
  }
  public function setEmail($email)
  {
    if (is_string($email))
    {
      $this->_email = $email;
    }
  }
  public function setPassword($password)
  {
	  if(is_string($password))
	  {
        $this->_password = $password;
	  }
  }
  public function setPhone($phone)
  {
	  if(is_string($phone))
	  {
        $this->_phone = $phone;
	  }
  }
  public function setCapcha($capcha)
  {
	  //Transforme le capcha de string en int
        $this->_capcha = intval($capcha);
  }
  public function setCapchaReponse($capchaReponse)
  {
	  //Transforme le capcha de string en int
        $this->_capchaReponse = intval($capchaReponse);
  }
  public function setLevel($level)
  {
	$level = (int) $level;
	  
      $this->_level = $level;
  }
}//Close class Client