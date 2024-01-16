<?php
        /*************************************************/
        /** OBJECT ORIENTED PROGRAMMING LANGAGE         **/
        /*************************************************/
        /** CLASS Page                                  **/
        /*************************************************/
        /** AUTHOR: Marc L. Harnist                     **/
        /*************************************************/
        /** CREATION: 19/07/2018                        **/
        /*************************************************/
        /** UPDATED:  18/06/2020                        **/
        /*************************************************/
        /** FILE USING THIS CLASS: root/index.php       **/
        /*************************************************/
        /** FUNCTION INSIDE: __construct, getters, setters
        *************************************************/

class PageManager extends Methods {

  //Attributs
  private $categories; // Chemin du menu des catégories
  private $controllerPath;  // Chemin du contrôleur. Exemple: controller/accueil.php
  private $cssLink; // Chemin de la feuille de style pour cette page si elle existe
  private $errorMessage;
  private $falseCars = ['.php'];
  private $fileName; // pageName.php Exemple: accueil.php
  private $footerPath; // Chemin du pied de page
  private $headerPath; // Chemin de l'en-tête de la page 
  private $pageName; // Nom de la page. Exemple : "accueil"
  private $pluginsPath;
  private $title; // Titre de la page qui s'affiche dans l'onglet du navigateur
  private $viewPath;        // Chemin de la vue. Exemple: view/accueil.php
  
    // Constructeur
    public function __construct(){
		$this->setPluginsPath(PLUGINS_PATH);
		$this->setPageName();
		$this->setTitle();
		$this->setFileName();
		$this->setControllerPath();
		$this->setViewPath();
		$this->setCssLink();
		$this->setHeaderPath();
		$this->setFooterPath();
		$this->setCategories();
    }
	/** Setters
	*
	*/
	private function setPageName($pageName = "accueil"){
		
		//Récupère la valeur de "page" dans l'url après "page=" et l'attribue à $pageName
		$pageName = !empty($_GET["page"]) ? htmlspecialchars($_GET['page']) : $pageName;

		//Erase false cars. 
		$this->pageName = $this->checkFalseCars($pageName);//Example: checkFalseCars(pageName.php) = pageName
	}
	/** Function setTitle()
	*   Set the title in the html bloc "<head>" in root/inc/header.php and in the url.
	*   This function is public because called in controller/page-from-pages-index.php
	*   The methode cleanPageName($string); is in class Methods wrotten 
	*/
	public function setTitle($string = "")
	{
        if(empty($string))//No title informed
			$this->title = $this->cleanPageName($this->pageName); // function in class Methods
		else //Title informed in the controller. Example : page-from-pages-index.php
			$this->title = $this->cleanPageName($string); // function in class Methods
	}
	private function setFileName($extension = ".php")
	{
		$this->fileName  = $this->pageName . $extension;//add extension to file name
	}
	private function setControllerPath($controllerPath = "controllers/accueil.php"){
		$this->controllerPath = $controllerPath; // Default value
		
		// If a file controller exists with this->fileName, define the path of the file
		if(is_file("controllers/" . $this->fileName)) $this->controllerPath = "controllers/" . $this->fileName;
		
		// If a plugin exists with this repertory name
		if(is_file($this->pluginsPath . $this->fileName)) $this->controllerPath = $this->pluginsPath . $this->fileName . "-controller";
		
		/** 2020 July new dir: PUBLIC ******************/
		$testPath  = "public/" . $this->fileName . "-controller";
		// If a controller exists in public (-controller: for Notepadd++ saving dir)
		if(is_file($testPath))
		{
			$this->controllerPath = $testPath;
		}
		
	}
	private function setViewPath($defaultPath =  "public/view/404.php")
	{
		$this->viewPath = $defaultPath; //View by default
		
		//If view exists define PAGE (real path) path of this file in view
		if(is_file("view/" . $this->fileName)) $this->viewPath =  "view/" . $this->fileName;
		
		// If a plugin exists with this repertory name
		$pluginsPath = str_replace(".php", "", $this->pluginsPath . $this->fileName);
		$pluginsPath = $pluginsPath . "/index.php";
		
		// if(is_file($pluginsPath)) exit("chemin du plugin : ".$pluginsPath); else exit("chemine du plugin : ".$pluginsPath);
		// include($pluginsPath);
		if(is_file($pluginsPath)) $this->viewPath = $pluginsPath;
		
		// If a plugin exists with this repertory name
		if(is_file($this->pluginsPath . $this->fileName))
		{
			$this->controllerPath = $this->pluginsPath . $this->fileName . "-controller";
		}
		/** Public ******************/
		$testViewPath = "public/view/" . $this->fileName;
		//Check if exists. If not, viewPath is default path
		if(is_file($testViewPath))
		{
			$this->viewPath = ""; //View by default
			$this->viewPath = $testViewPath;
		}
		
		/** ROOTER 
		*   Public / admin 
		*   Root/public/admin/ replace root/controller/__admin-index.php
		*   Root/public/admin/admin.php replace root/view/__admin-index.php
		*   Root/.htaccess : url rewriting, so Light/admin is the same
		*   url as Light/index.php?page=__admin-index !
		*   No more index.php? in url !
		* 
		**************************************************************/
		$testViewPathPublicAdmin = "public/admin/" . $this->fileName;
		
		//Check if exists. If not, viewPath is default path
		if(is_file($testViewPathPublicAdmin))
		{
			//Verify member rights to see this page
			$levelAdmin = 3;
			if($_SESSION)
			{
				if(!$_SESSION['member'])
				{
					$this->setViewPath("view/connexion.php");
					$this->setControllerPath("controllers/connexion.php");
				}
				elseif(!isset($member))
				{
					$website = new Website; //Usefull method. Write websame in header
					$member  = $website::session();//$_Session['member'] avoid to create object $member.
					
					if(isset($member) && $member->level() > $levelAdmin)
					//Si le visiteur n'a pas le niveau (droits)
					{
						$this->viewPath = "view/acces-limite.php";
						$this->setControllerPath("controllers/acces-limite.php");
					}
					elseif(isset($member) && $member->level() < $levelAdmin)
					{
						//This member has all permissions
						$this->viewPath = $testViewPathPublicAdmin;
						
						//New controller in root/public
						$newController = "public/admin/" . $this->pageName . "-controller.php";//	(pageName has not the extension .php)
						
						$this->setControllerPath($newController);
					}
				}
			}
			elseif(!isset($member))
			//Si le visiteur n'a pas le niveau (droits)
			{
				//$ member n'existe pas";
				$this->viewPath = "view/connexion.php";
				$this->setControllerPath("controllers/connexion.php");
			}
		}		
	}
	public function setCssLink(){
		$this->cssLink = $this->cssLink($this->pageName); //Create a css link in head for this page with class "Methods" (see extends)
	}
	private function setHeaderPath($headerPath = "inc/header.php"){
		$this->headerPath = $headerPath;
	}
	private function setFooterPath($footerPath = "inc/footer.php"){
		$this->footerPath = $footerPath;
	}
	private function setCategories($categories = "inc/categories.php"){
		$this->categories = $categories;
	}
	private function setErrorMessage(String $messageText){
		$this->errorMessage = $messageText;
	}
	private function setPluginsPath($pluginsPath = "engine/"){
		$this->pluginsPath = $pluginsPath;
	}
	/** Getters
	*
	*/
    public function getPageName(){
		return $this->pageName;
    }
	public function getTitle(){
		return $this->title;
	}
    public function getFileName(){
		return $this->fileName;
    }
	public function getControllerPath(){
		return $this->controllerPath;
	}
	public function getViewPath(){
		return $this->viewPath;
	}
	public function getCssLink(){
		return $this->cssLink;
	}
	public function getheaderPath(){
		return $this->headerPath;
	}
	public function getFooterPath(){
		return $this->footerPath;
	}
	public function getCategories(){
		return $this->categories;
	}
	public function getErrorMessage(){
		return $this->errorMessage;
	}
	public function getFalseCars(){
		return $this->falseCars;
	}
	public function getPluginsPath(){
		return $this->pluginsPath;
	}
	
	/** Other methodes
	*
	*/
	private function checkFalseCars(string $pageName = "noName"){
		return str_replace($this->getFalseCars(), "", $pageName);
	}
}