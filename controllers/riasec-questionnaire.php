<?php 

///// MOVE NEXT LINES TO --> CONFIG FILE -- WHEN ALL WORK IS FINISHED
define("NBRE_QUESTIONS_BY_PAGE", 6); //In config file !
define("NBRE_QUESTIONS_OF_DEMO", 15); // Demo 6 questions only without user registering

$currentTheme;
$database = new Database;
$db_table_questions = TABLE_QUESTIONS;//Base de données
$db_table_user = TABLE_USERS;//Base de données
$db_table_themes = TABLE_THEMES;//(categories) "Activité", "occupation", "caractère", "compétence"
$db_questions = $database->read_table($db_table_questions);
$nbQuestions = count($db_questions);
$firstTheme = "activité";
$i_questions = 0;
$models   = ["select-all-by-two-fields" => 'models/select-all-by-two-fields.php',
			"try-and-catch-training" => "models/try-and-catch-training.php"];
$messages = [ "select-all-by-two-fields"  => '<p>'.$models["select-all-by-two-fields"].' non trouvé.</p>',
			 "try-and-catch-training" => '<p>'.$models["try-and-catch-training"].' non trouvé.</p>'
			];
// $nberQuestionsAnswered = 6;//Counter : start with 6 because the first page's already counted 
$nberQuestionsByPage = NBRE_QUESTIONS_BY_PAGE;
$nberQuestionsOfDemo = NBRE_QUESTIONS_OF_DEMO;
$pageWith3choicesPerQuestions = "compétence";
$profile3letters = "";
$nberOfQuestionsLeft = isset($_POST['nberOfQuestionsLeft'])?$_POST['nberOfQuestionsLeft']:count($db_questions);
$themes = ["activité", "occupation", "compétence", "caractère"];//occupation = other view
$currentTheme = isset($_POST["currentTheme"])?$_POST["currentTheme"]:$firstTheme;
//Get user's his saved values
if(isset($_POST['user_name']))
{
	$user = new User();
	isset($_POST['user_name'])?$user->setName($_POST['user_name']):"";
	isset($_POST['user_firstName'])?$user->setFirstName($_POST['user_firstName']):"";
	isset($_POST['user_r'])?$user->setR($_POST['user_r']):"";
	isset($_POST['user_i'])?$user->setI($_POST['user_i']):"";
	isset($_POST['user_a'])?$user->setA($_POST['user_a']):"";
	isset($_POST['user_s'])?$user->setS($_POST['user_s']):"";
	isset($_POST['user_e'])?$user->setE($_POST['user_e']):"";
	isset($_POST['user_c'])?$user->setC($_POST['user_c']):"";
}
//If user do not exists
elseif(!isset($user))
{ 
	$user = new User();
}

if(isset($_POST['introHasBeenRead']) && $_POST['introHasBeenRead'] === "yes")
{
	$introHasBeenRead = "yes"; 
	
	//Save in admin/statistics
	$return = $database->statsIncrementPage($currentTheme);// $return = Exception e->getMessage();

	//Erase "@@" in "anchor@@" below to get and display the Exception $e->getMessage(); from the class Page
	if(isset($return['anchor@@']) && isset($return["messageException"])):
		?>
		<p><?=$return["messageException"]?></p>
		<p>Ancre : <?=isset($return["anchor"])?$return["anchor"]:""?></p>
		<?php
	endif;
}
else
{ 
	$introHasBeenRead = "no";
}

//Search next theme
foreach($themes as $key => $theme)
{
	switch($theme)
	{
		case $currentTheme:
		if(isset($themes[$key+1]))
		{
			$nextTheme = $themes[$key+1];
		}
		else
		{
			$nextTheme = $firstTheme;
		}
		break;
	}
}
//Import models
file_exists($models["select-all-by-two-fields"])?
   require($models["select-all-by-two-fields"]):
   exit($messages["select-all-by-two-fields"]);//Import all config files

//Count 1 questions / 15 or 1/10
if(isset($_POST['i_questions'])) $i_questions = $_POST['i_questions'];

//Order questions by theme
$questionsByTheme = array();
foreach($themes as $key => $theme)
{
	$questionsByTheme[$theme] = array();
	foreach($db_questions as $db_question)
	{
		switch($db_question['theme'])
		{
			case $theme:
			$questionsByTheme[$theme][] = $db_question;
			break;
		}
	}
	$nberQuestionsByTheme[$theme] = count($questionsByTheme[$theme]);
}
//Create 6 arrays for 6 profiles
$questionsRealistic =
$questionsInvestigator =
$questionsArtistic =
$questionsSocial =
$questionsEnterprising =
$questionsConventional = array();

$nQuestionsByTheme = count($questionsByTheme[$currentTheme]);// 90 for activities

//Goes through all the questions of that $currentTheme and add value to the 6 arrays
for($i=0;$i<$nQuestionsByTheme;$i++)	
{
	switch($questionsByTheme[$currentTheme][$i]['profile'])
	{
		case 'realiste':
		$questionsRealistic[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
		case 'investigateur':
		$questionsInvestigator[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
		case 'artistique':
		$questionsArtistic[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
		case 'social':
		$questionsSocial[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
		case 'entreprenant':
		$questionsEnterprising[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
		case 'conventionnel':
		$questionsConventional[] = $questionsByTheme[$currentTheme][$i]['question'];
		break;
	}
}	
$questionsToDisplay = array();
$questionsToDisplay[$currentTheme] = array();
$nQuestionsByTheme = count($questionsByTheme[$currentTheme]);// 90 for activities
$nQuestionsPerPage = $nQuestionsByTheme/6;

//Chose one questions of each 6 array by page (step)
for($j=0;$j<$nQuestionsPerPage;$j++)
{
	if(isset($questionsRealistic[$j]))
	{
		
		$questionsToDisplay[$currentTheme][$j] = [
			'realiste' => $questionsRealistic[$j],
			'investigateur' => $questionsInvestigator[$j],
			'artistique' => $questionsArtistic[$j],
			'social' => $questionsSocial[$j],
			'entreprenant' => $questionsEnterprising[$j],
			'conventionnel' => $questionsConventional[$j]
			];
	}
}
//Posts from view/riasec-questionnaire
if(isset($_POST))
{
	foreach($_POST as $key => $value)
	{
		$points = 0;
		switch($value)
		{
			case "on":
			$points = 1;
			break;
			case "1":
			$points = 1;
			break;
			case "2":
			$points = 2;
			break;
			case "3":
			$points = 3;
			break;
		}
		$user->addPointInProfile($key, intval($points));
	}	
}

//Final result 
$i = 0;
$maxValuesRiasec = 3;
$finalResult = [];
$userResults = $user->getResult();

arsort($userResults);//arsort do not erase the keys

//Get the third better scores
foreach($userResults as $key => $value)
{
	if($i<($maxValuesRiasec)) $finalResult[] = ucfirst($key[0]);
	$i++;
}
