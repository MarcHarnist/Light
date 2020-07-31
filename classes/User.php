<?php
/* 
*   
*/
class User {
  private $id,
          $firstName,
          $name,
          $password,
		  $r,//score in r
		  $i,//score in i
		  $a,//...
		  $s,
		  $e,
		  $c;

  public function __construct(string $firstName = "John", string $name = "Doe", int $id = 1)
  {
	  $this->setId($id);
	  $this->setFirstName($firstName);
	  $this->setName($name);
	  $this->setR(0);
	  $this->setI(0);
	  $this->setA(0);
	  $this->setS(0);
	  $this->setE(0);
	  $this->setC(0);
  }

public function addPointInProfile(string $profileName, int $points = 1)
{
	switch($profileName)
	{
		case "realiste";
		$this->r = $this->r + $points;
		break;
		case "investigateur";
		$this->i = $this->i + $points;
		break;
		case "artistique";
		$this->a = $this->a + $points;
		break;
		case "social";
		$this->s = $this->s + $points;
		break;
		case "entreprenant";
		$this->e = $this->e + $points;
		break;
		case "conventionnel";
		$this->c = $this->c + $points;
	}
}
  
  // GETTERS //
  public function getId()
  {
    return $this->id;
  }
  public function getFirstName()
  {
    return $this->firstName;
  } 
  public function getName()
  {
    return $this->name;
  } 
  public function getPassword()
  {
    return $this->password;
  } 
  public function getR()
  {
    return $this->r;
  } 
  public function getI()
  {
    return $this->i;
  } 
  public function getA()
  {
    return $this->a;
  } 
  public function getS()
  {
    return $this->s;
  } 
  public function getE()
  {
    return $this->e;
  } 
  public function getC()
  {
    return $this->c;
  } 

  // Fin du rajout de Marc
  public function setId($id)
  {
    $id = (int) $id;
    
    if ($id > 0)
    {
      $this->id = $id;
    }
  }
  public function setFirstName($firstName)
  {
    if (is_string($firstName)) $this->firstName = $firstName;
  }
  public function setName($name)
  {
    if (is_string($name)) $this->name = $name;
  }
  public function setPassword($password)
  {
	  if(is_string($password)) $this->password = $password;
  }
  public function setR($r)
  {
      $this->r	  = $r;
  }
  public function setI($i)
  {
      $this->i	  = $i;
  }
  public function setA($a)
  {
      $this->a	  = $a;
  }
  public function setS($s)
  {
      $this->s	  = $s;
  }
  public function setE($e)
  {
      $this->e	  = $e;
  }
  public function setC($c)
  {
      $this->c	  = $c;
  }
  public function __toString()
  {
	  $repport = 
		// $this->getFirstName() . ' ' . $this->getName() . ", 
		"valeur en réaliste : " . $this->getR() . ", 
		valeur en investigateur : " . $this->getI() . ", 
		valeur en artistique : " . $this->getA() . ", 
		valeur en social : " . $this->getS() . ", 
		valeur en entreprenant : " . $this->getE() . ", 
		valeur en conventionnel : " . $this->getC() . ".";
	  return $repport;
  }
  public function getResult()
  {
	$array = [
			"realiste" => $this->getR(),
			"investigateur" => $this->getI(),
			"artistique" => $this->getA(),
			"social" => $this->getS(),
			"entreprenant" => $this->getE(),
			"conventionnel" => $this->getC()
	];
	 return $array;
  }
}//Close class Member