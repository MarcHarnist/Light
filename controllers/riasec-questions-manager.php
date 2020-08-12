<?php 

//Only for the owner and webmaster
$website->membersPermissions(2, $member);// 4 = level of permission, $member = object

$ancre = "";
$anchor = $count = 1;//counters for anchors creations
$db_table_themes = TABLE_THEMES;//Constants from config
$db_table_questions = TABLE_QUESTIONS;//Constants from config
$db_table_profiles = TABLE_PROFILES;//Constants from config
$database = new Database;//Connect to db and give some usefull methods

$theme_choice = isset($_GET["theme_choice"])?$_GET["theme_choice"]:"";

//Questions
if(isset($_POST['operation']))
	$ancre = $database->update_table_riasec_questions($db_table_questions, $_POST);

$lastProfileChoosen = isset($_POST['profile'])?$_POST['profile']:"";
$lastThemeChoosen = isset($_POST['theme'])?$_POST['theme']:"";

$questions = $database->read_table($db_table_questions);	
$themesList = $database->read_table($db_table_themes);	
$profilesList = $database->read_table($db_table_profiles);	
sort($questions);//(Fr: tri le tableau)


