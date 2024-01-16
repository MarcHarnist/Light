<?php 

// Dev tools : var to uncomment 
// $nberOfQuestionsLeft = 4;//To display last page
// $currentTheme = "compétence";//To see the page "intro-competences"

if($nberOfQuestionsLeft > 5): ?>
	<!-- PROGRESS BAR -->
	<figure style="width:<?=$nbQuestions?>px;  height:22px; border: 2px solid green; margin:10px auto; border-radius:10px; background-color:lightgreen;">
		<div style="width:<?=$nbQuestions-$nberOfQuestionsLeft?>px; height:20px; background-color:green; border-radius:5px; "></div>
	</figure>
	<?php
	//Import theme introduction if $i_questions = 0 (1rst questions of this theme)
	if(isset($introHasBeenRead) && $introHasBeenRead === "no" && isset($currentTheme) && isset($i_questions) && $i_questions == 0):

		$currentThemeCleaned = $page->cleanAccents($currentTheme);
		$themeIntroduction = "public/view/intro-".$currentThemeCleaned.".php";
		if(is_file($themeIntroduction)):?>
			
			<article>
				<h3>Introduction au thème <?=$currentTheme?></h3>
				<p>
				<?php
				require($themeIntroduction);
				?>
				</p>
				<form action="questionnaire" method="post">
					<input type="hidden" name="introHasBeenRead" value="yes">
					<input type="hidden" name="i_questions" value="<?=$i_questions?>">
					<input type="hidden" name="user_name" value="<?=$user->getName()?>">
					<input type="hidden" name="user_firstName" value="<?=$user->getFirstName()?>">
					<input type="hidden" name="user_r" value="<?=$user->getR()?>">
					<input type="hidden" name="user_i" value="<?=$user->getI()?>">
					<input type="hidden" name="user_a" value="<?=$user->getA()?>">
					<input type="hidden" name="user_s" value="<?=$user->getS()?>">
					<input type="hidden" name="user_e" value="<?=$user->getE()?>">
					<input type="hidden" name="user_c" value="<?=$user->getC()?>">
					<input type="hidden" name="currentTheme" value="<?= $currentTheme ?>">
					<input type="hidden" name="nberOfQuestionsLeft" value="<?= $nberOfQuestionsLeft ?>">
					<input class="btn mt-3" type="submit" value="continuer">
				</form>
			</article>
		<?php
		else: 
			?>
			<p class="messageRed">Fichier d'introduction au thème non trouvé.<br>
			Chemin du fichier : <?=$themeIntroduction?></p>
			<?php
		endif;
	else :
		?>
		
		
		<!-- UNCOMMENT FOR DEVELOPPEMENT -->
		<!--
			<p>View line  <?php
			// echo __LINE__ ;
			?>  : $user : <?php
			// echo $user;
			?>
			<br>
			Nombre de questions : 
			<?php 
			// echo count($db_questions);?>
			. Questions restantes : <?
			// echo $nberOfQuestionsLeft;
			?>
			.<br>
			$currentTheme = <?
			// =$currentTheme;?><br>
			$nextTheme = <?
			// =$nextTheme;?><br>
			</p>
		-->
		<h6 class="questionnaireTitle">Thème : <?= $currentTheme ?> - Etape <?=$i_questions+1;?> / <?=($nberQuestionsByTheme[$currentTheme]/$nberQuestionsByPage)?></h6>

		<?php
			//$questionCounter give a n° to input names to make all names different.
			$questionCounter = 1;//6 questions per page
		?>
		<!-- action="" (url rewritting in htaccess -->
		<form class="questionnaire" action="questionnaire" method="post">
			<?php
			if(isset($questionsToDisplay[$currentTheme][$i_questions]['realiste'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_realiste">
							<!-- Question for first profile, letter R (En: realistic) (Fr: réaliste ) -->
							<?=$questionsToDisplay[$currentTheme][$i_questions]['realiste']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="realiste">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="realiste" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="realiste" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="realiste" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="realiste" id="question_realiste">
					<?php
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;

			if(isset($questionsToDisplay[$currentTheme][$i_questions]['investigateur'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_investigateur">
						<!-- Question for second profile, letter I (En: investigator, Fr: investigateur )-->
						<?=$questionsToDisplay[$currentTheme][$i_questions]['investigateur']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="investigateur">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="investigateur" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="investigateur" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="investigateur" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="investigateur" id="question_investigateur">
					<?php 
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;

			if(isset($questionsToDisplay[$currentTheme][$i_questions]['artistique'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_artistique">
						<?=$questionsToDisplay[$currentTheme][$i_questions]['artistique']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="artistique">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="artistique" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="artistique" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="artistique" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="artistique" id="question_artistique">
					<?php 
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;
			
			if(isset($questionsToDisplay[$currentTheme][$i_questions]['social'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_social">
						<?=$questionsToDisplay[$currentTheme][$i_questions]['social']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="social">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="social" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="social" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="social" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="social" id="question_social">
					<?php 
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;
			
			if(isset($questionsToDisplay[$currentTheme][$i_questions]['entreprenant'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_entreprenant">
						<?=$questionsToDisplay[$currentTheme][$i_questions]['entreprenant']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="entreprenant">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="entreprenant" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="entreprenant" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="entreprenant" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="entreprenant" id="question_entreprenant">
					<?php 
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;
			
			if(isset($questionsToDisplay[$currentTheme][$i_questions]['conventionnel'])):?>
				<div class="row question">
					<div class="col-lg-9 col-9">
						<label for="question_conventionnel">
						<?=$questionsToDisplay[$currentTheme][$i_questions]['conventionnel']?>
						</label> 
						<input type="hidden" name="profile_question=<?=$questionCounter ?>" value="conventionnel">
					</div>
					<div class="col-lg-3 col-3">
					<?php
					if($currentTheme === $pageWith3choicesPerQuestions): ?>
							<input type="radio" name="conventionnel" id="faible<?=$questionCounter?>" value="1" required>
							<label for="faible<?=$questionCounter?>"> - </label><br>
							<input type="radio" name="conventionnel" id="moyen<?=$questionCounter?>" value="2">
							<label for="moyen<?=$questionCounter?>"> + </label><br>
							<input type="radio" name="conventionnel" id="fort<?=$questionCounter?>" value="3">
							<label for="fort<?=$questionCounter?>"> ++ </label><br>
					<?php
					else: ?>
						<input type="checkbox" name="conventionnel" id="question_conventionnel">
					<?php 
					endif; ?>
					</div>
				</div>
				<?php
				$questionCounter++;
			endif;
			$i_questions++;//Update counter
			$nberOfQuestionsLeft = $nberOfQuestionsLeft - 6;
			?>

			<input type="hidden" name="i_questions" value="<?=$i_questions?>">
			<input type="hidden" name="user_name" value="<?=$user->getName()?>">
			<input type="hidden" name="user_firstName" value="<?=$user->getFirstName()?>">
			<input type="hidden" name="user_r" value="<?=$user->getR()?>">
			<input type="hidden" name="user_i" value="<?=$user->getI()?>">
			<input type="hidden" name="user_a" value="<?=$user->getA()?>">
			<input type="hidden" name="user_s" value="<?=$user->getS()?>">
			<input type="hidden" name="user_e" value="<?=$user->getE()?>">
			<input type="hidden" name="user_c" value="<?=$user->getC()?>">
			<input type="hidden" name="currentTheme" value="<?= $currentTheme ?>">
			<input type="hidden" name="nberOfQuestionsLeft" value="<?= $nberOfQuestionsLeft ?>">

			<?php //All questions of this theme were answered. Next theme...
			if($i_questions >= $nberQuestionsByTheme[$currentTheme]/6):?>
			
			<input type="hidden" name="i_questions" value="0">
			<input type="hidden" name="currentTheme" value="<?= $nextTheme ?>">
		
			<?php
			endif;
			?>
			<input class="btn mt-3" type="submit" value="continuer">
			<?php
			if(isset($message)) echo $message; ?>
		</form>
		<?php
    endif;// close else from if(isset($currentTheme) && isset($i_questions) && $i_questions == 0):
else: // $nberOfQuestionsLeft < 5
	?>
	<article>

		<h3>Bravo : vous avez fini !</h3>

		<p>Vous avez un profil : 
		<span class="finalResult">
		<?php foreach($finalResult as $letter): ?>
		
		<span class="finalResultLetter"><?=$letter?></span>
		<?php 
		$profile3letters .= $letter;
		endforeach; ?>
		</span>
		</p>
		
		<!-- WHEN VERSION COMPLETE IS READY = uncomment here -->
		<?php if(DOMAIN === "riasec"):?>
		<p><a href="<?=VERSION_COMPLETE_LINK?>"><!-- Test la version complète --></a></p>
		<?php endif;?>
	
		<form method="post" action="index.php?page=riasec-recevoir-resultat-par-mail">
		<input type="hidden" name="user_name" value="<?=$user->getName()?>">
		<input type="hidden" name="user_firstName" value="<?=$user->getFirstName()?>">
		<input type="hidden" name="user_r" value="<?=$user->getR()?>">
		<input type="hidden" name="user_i" value="<?=$user->getI()?>">
		<input type="hidden" name="user_a" value="<?=$user->getA()?>">
		<input type="hidden" name="user_s" value="<?=$user->getS()?>">
		<input type="hidden" name="user_e" value="<?=$user->getE()?>">
		<input type="hidden" name="user_c" value="<?=$user->getC()?>">
		<input type="hidden" name="profile3letters" value="<?=$profile3letters?>">
		<input class="btn mt-3" type="submit" value="Recevoir le resultat par mail">
	</article>
	<?php
	
	//Unset all vars
	unset($_POST['currentTheme']);
	unset($currentTheme);
endif; // close 	if($i_questions <= $nberQuestionsThisTheme):
