<?php
/* by Marc Harnist 2017 */
  class Message
  {
    private $red;
	private $green;
	private $normal;
	
	public function setRed($red)
	{
		$this->red = $red;
	}
	public function setGreen($green)
	{
		$this->green = $green;
	}
	public function setNormal($normal)
	{
		$this->normal = $normal;
	}
	public function getRed()
	{
		return $this->red;
	}
	public function getGreen()
	{
		return $this->green;
	}
	public function getNormal()
	{
		return $this->normal;
	}
	public function addRed($red)
	{
		$this->red .= $red;
	}
	public function addGreen($green)
	{
		$this->green .= $green;
	}
	public function addNormal($normal)
	{
		$this->normal .= $normal;
	}
	public function __toString()
	{
		$retour = "";
		$retour = $this->green!==null?$this->green:$retour;
		$retour .= $this->normal!==null?$this->normal:$retour;
		$retour .= $this->red!==null?$this->red:$retour;
		$retour = $retour === "" ? "Pas de message." : $retour;
		return $retour;
	}
}