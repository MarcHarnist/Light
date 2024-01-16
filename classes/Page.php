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

class Page extends Methods {

  //Attributs
  private $categories; // Chemin du menu des catégories
  private $controllerPath;  // Chemin du contrôleur. Exemple: controller/accueil.php
  private $classicRepertoryOfTheView;
  private $classicRepertoryOfTheControllers = "controllers/";
  private $cssLink; // Chemin de la feuille de style pour cette page si elle existe
  private $denyedDirs = [".git", "classes", "img", "js", "models", ".gitattributes", ".htaccess", "README.md", "sql", "config", "css", "inc"];
  private $domain;
  private $errorMessage;
  private $falseCars = ['.php'];
  private $fileName; // pageName.php Exemple: accueil.php
  private $footerPath; // Chemin du pied de page
  private $headerPath; // Chemin de l'en-tête de la page 
  private $pageName; // Nom de la page. Exemple : "accueil"
  private $title; // Titre de la page qui s'affiche dans l'onglet du navigateur
  private $viewPath;// Chemin de la vue. Exemple: view/accueil.php
  private $publicPath;
  private $pageInStats = ["accueil", "riasec-recevoir-resultat-par-mail"];
  private $directories;
  
    // Constructeur
    public function __construct(){
        $this->setPublicPath(PUBLIC_PATH);//defined in config/config.php
        $this->setDomain(DOMAIN);//defined in config/config.php
        $this->classicRepertoryOfTheView = $this->getPublicPath()."/view/";
        $this->setDirectories();
        $this->setPageName();
        $this->setTitle();
        $this->setFileName();
        // $this->setControllerPath();
        $this->setViewPath();
        $this->setCssLink();
        $this->setHeaderPath();
        $this->setFooterPath();
        $this->setCategories();

        
    }
    /** Setters
    *
    */
    private function setPageName($pageName = "accueil")
    {
        //Classic url : index.php?page=homepage. Code below push "homepage" in $pageName
        $pageName = !empty($_GET["page"]) ? htmlspecialchars($_GET['page']) : $pageName;
        //If no page name, this code push "accueil" from function prototype in $pageName;

        //Erase false cars define above in private variables declarations
        $this->pageName = $this->checkFalseCars($pageName);
        //Example: checkFalseCars(homepage.php) becomes "homepage"
    }
    private function setDirectories()
    {
        // $root    = '../riasec';
        $root = "../".$this->domain;
        $denyedDirs = $this->denyedDirs;
        $directories = array();

        //ACTION
        $listOfDirs = $this->find_all_files($root, $denyedDirs);
        $listOfDirs = $this->getOnlyDirname($listOfDirs);
        $this->directories = $listOfDirs;
    }
    /** Function setTitle()
    *   Set the html page bloc "<head>" title in root/inc/header.php and in the url.
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
    private function lookInDirAndCreatePathsIfFind(string $lookInDir)
    {
    
        $lookInDir = $lookInDir."/";

        if(is_dir($lookInDir))
        {
        
            // var_dump(($lookInDir.$this->fileName));
            if(is_file($lookInDir.$this->fileName))
            {
                //Check if "admin" exists in dir path
                $explodedPath = (explode("/", $lookInDir));
                if(in_array("admin", $explodedPath) || in_array("maintenance", $explodedPath) )
                {
                    //"admin" inside : check visitor permissions to see this
                    $connection = $this->checkUserRightsForAdmin();
                    
                    if($connection['session'] === False)
                    {
                        //Require connexion page in index.php
                        $this->viewPath = PUBLIC_PATH."/view/connexion.php";
                        $this->setControllerPath("controllers/connexion.php");
                        return True;
                    }
                    elseif($connection['rights'] === False)
                    {    
                        //Require view "limited acces" in index.php
                        $this->viewPath = PUBLIC_PATH."/view/acces-limite.php";
                        $this->setControllerPath("controllers/acces-limite.php");
                        return True;
                    }
                }
                $this->viewPath = $lookInDir.$this->fileName;

                if(is_file($this->classicRepertoryOfTheControllers.$this->fileName))
                {
                    $this->setControllerPath($this->classicRepertoryOfTheControllers.$this->fileName);
                    return true;
                }
                elseif(is_file($lookInDir.$this->pageName."-controller.php"))
                {
                        // var_dump(($lookInDir.$this->pageName."-controller.php"));
                    $this->setControllerPath($lookInDir.$this->pageName."-controller.php");
                    return true;
                }
                $this->countInStat($this->pageName);
                
                return True;
            }
            else return false;
        }
        else return false;
    }
    
    private function setViewPath($defaultPage = "404.php")
    {
        // Default path of view and controller
        $classicRepertoryOfTheView = $this->getPublicPath()."/view/";
        $classicRepertoryOfTheControllers = "controllers/";
        $defaultPage = $classicRepertoryOfTheView.$defaultPage;//defaut page = 404
        $this->viewPath = $defaultPage;// 404.php
        $listOfDirs = $this->getDirectories();

        //Array of repertories where this page will be search
        // $repertories = [
            // $classicRepertoryOfTheView,
            // "public/admin/",
            // "public/admin/page-manager/",
            // "public/admin/statistiques/"
        // ]; 
        
        $repertories = $this->getDirectories();
        

        foreach($repertories as $repertory)
        {
            $search = $this->lookInDirAndCreatePathsIfFind($repertory);
                // var_dump($search);
            if($search === True)
            {
                continue;
            }    
        }
    }// close "function setViewPath($defaultPage = "public/view/404.php")"
            
    //Function find_all_files found in https://www.php.net/manual/fr/
    private    function find_all_files($dir, $denyedDirs)
    {
        $result = array();
        $root = scandir($dir);
        foreach($root as $value)
        {
            if($value === '.' || $value === '..' || in_array($value,$denyedDirs))
            {
                continue;
            }
            if(is_file("$dir/$value"))
            {
                $result[]="$dir/$value";
                continue;
            }
            foreach($this->find_all_files("$dir/$value", $denyedDirs) as $value)
            {
                $result[]=$value;
            }
        }
        return $result;
    }
    public function findDir(string $testDir)
    {
        $directories = [
            "public" => $this->getPublicPath(),
            "admin" => $this->getPublicPath(). "/admin",
        ];
        //Is the repertory in root ?
        $testInside = $testDir;
        if(is_dir($testInside))
        {
            return $testInside;
        }
        foreach($directories as $dir)
        {
            $testInside = $dir . '/'.$testDir;
            if(is_dir($testInside))
            {
                return $testInside;
                continue;
            }
        }
        return False;
    }
    private function checkUserRightsForAdmin()
    {
        $levelAdmin = 3;
        $connection = ["session" => False, "rights" => False];//All false by default
        
        if($_SESSION)
        {
            if(!isset($_SESSION['member']))
            {
                return $connection;//False
            }
            elseif(!isset($member))
            {
                $connection["session"] = True;

                $website = new Website; //Usefull method. Write website name in header
                $member  = $website::session();//$_Session['member'] avoid to create object $member.
                
                if(isset($member) && $member->level() > $levelAdmin)
                {
                    //Session true but member's rights to low
                    return $connection;
                }
                elseif(isset($member) && $member->level() < $levelAdmin)
                {
                    //This member has all permissions
                    $connection['rights'] = True;
                    return $connection;
                }
            }
        }
        return $connection;
    }
    private function countInStat(string $pageName)
    {
        $pageName = $this->pageName;
        
        //For stats, statistics, statistique
            if(in_array($pageName, $this->pageInStats) === True)
            {
                $db = new Database;
                
                $return = $db->statsIncrementPage($pageName);
                // $return = Exception e->getMessage();
            }
            //Erase "@@" in "anchor@@" below to get and display the Exception $e->getMessage(); from the class Page
            if(isset($return['anchor@@']) && isset($return["messageException"])):
                ?>
                <p><?=$return["messageException"]?></p>
                <p>Ancre : <?=isset($return["anchor"])?$return["anchor"]:""?></p>
                <?php
            endif;
            return True;
    }
    private function setControllerPath(string $path)
    {
        if(is_file($path))
        {
            $this->controllerPath = $path;
        }
    }
    public function setCssLink(){
        $this->cssLink = $this->getPageName().".css"; //Create a css link in head for this page with class "Methods" (see extends)
    }
    private function setHeaderPath($headerPath = "inc/header.php"){
        $this->headerPath = $headerPath;
        $tryFile = $this->getPublicPath(). "/" . $headerPath;
        if(is_file($tryFile))
            $this->headerPath = $tryFile;
    }
    private function setFooterPath($footerPath = "inc/footer.php")
    {
        $tryFile = $this->getPublicPath(). "/" . $footerPath;
        is_file($tryFile)?$this->footerPath = $tryFile:$footerPath;
    }
    private function setCategories($categories = "inc/categories.php"){
        $this->categories = $categories;
    }
    private function setErrorMessage(String $messageText){
        $this->errorMessage = $messageText;
    }
    private function setPublicPath($publicPath = "public/"){
        $this->publicPath = $publicPath;
    }
    private function setDomain($domain){
        $this->domain = $domain;
    }
    
    /** Getters
    *
    */
    private function getOnlyDirname($array)
    {
        for($i=0; $i<count($array); $i++)
        {
            $array[$i] = dirname($array[$i]);
        }
        return array_unique($array);
    }
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
    public function getPublicPath(){
        return $this->publicPath;
    }
    public function getDirectories()
    {
        return $this->directories;
    }
    /** Other methodes
    *
    */
    private function checkFalseCars(string $pageName = "noName"){
        return str_replace($this->getFalseCars(), "", $pageName);
    }
}