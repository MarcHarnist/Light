<?php
  public $pageName; // Nom de la page. Exemple : "accueil"
  public $title; // Titre de la page qui s'affiche dans l'onglet du navigateur
  public $fileName; // pageName.php Exemple: accueil.php
  public $viewPath;        // Chemin de la vue. Exemple: view/accueil.php
  public $header      =  "inc/header.php";
  public $footer      =  "inc/footer.php";
  public $categories  =  "inc/categories.php";
  public $controllerPath;  // Chemin du contrôleur. Exemple: controller/accueil.php
  public $css         =  '(Root/classes/Page/28 : Aucun style spécifique pour cette page.)'."\n";                   // See above getPage()
  private $errorMessage;
  
    // Constructer
    public function __construct(){
		$this->setPageName();
		$this->setFileName();
		$this->setViewPath();
		$this->setControllerPath();
		$this->setCssPath();
    }

	private function setPageName($pageName = "accueil")
	{
		$this->pageName = $pageName; //Valeur par défaut

        //Regarde si la variable super globale GET contient une valeur pour "page"
        if(!empty($_GET["page"]))
		{
			//Récupère la valeur de "page" dans l'url après "page=" et l'attribue à $pageName
		    $this->pageName = htmlspecialchars($_GET['page']);//Get what is written in url after "page="
		}
	}

	private function setTitle($title = 'accueil')
	{
		$this->title = $title; //Valeur par défaut
        $this->title = $this->cleanPageName($this->pageName); // function in class Methods
		
	}
	private function setFileName()
	{
		$this->fileName  = $this->pageName . '.php'; //Ajoute l'extension pour trouver le fichier php
	}
	private function setViewPath($viewPath =  "view/vue_par_defaut.php")
	{
		$this->view = $viewPath; //View by default
		
		//If view exists define PAGE (real path) path of this file in view
		if(is_file("view/" . $this->fileName)) $this->viewPath =  "view/" . $this->fileName;
	}
	public function getViewPath()
	{
		return $this->viewPath;
	}
	private function setControllerPath($controllerPath = "controllers/accueil.php")
	{
		$this->controllerPath = $controllerPath; // Default value
		
		// If a file controller exist with this file name: we define the path of the file
		if(is_file("controllers/" . $this->fileName)) $this->controllerPath = "controllers/" . $this->fileName;
	}
	public function getControllerPath()
	{
		return $this->controllerPath;
	}
	public function getTitle()
	{
		return $this->title;
	}

	public function getPageName()
	{
		return $this->pageName;
	}

    public function getPage(){

        //  Read page name with methode GET
        if(!empty($_GET['page'])){
		
			//Crée un lien vers la feuille de style de cette page si elle existe
			$this->css = $this->cssLink($this->pageName); //Create a css link in head for this page with class "Methods" (see extends)
        } else {
			//La méthode get est vide
			//aucun nom de page n'a encore été renseigné avec la méthode getPage
			//Paramètre le style de la page avec la class "Methods"
			$this->css = $this->cssLink($this->pageName); //Create a css link in head for this page with class "Methods" (see extends)
		}
    }
	private function setErrorMessage(String $messageText)
	{
		$this->errorMessage = $messageText;
	}
	private function setView($view = 'view/accueil.php')
	{
        if(is_file("view/" . $this->fileName)) $this->view =  "view/" . $this->fileName;
	}
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}
}