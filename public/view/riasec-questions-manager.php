<?php
if(isset($theme_choice) && isset($ancre))
{
	?>

<article class="mt-5 questionnaire">
	<p>
		<u>
			<a href="index.php?page=riasec-questionnaire" target="_blank">Voir le questionnaire public</a></u> - <u>
		<?php if($ancre === false):?>
			<br><span class="h3 text-danger">Vous ne pouvez pas écrire de code html ou du texte entre "< >" dans les questions du formulaire.</span><br>
		<?php endif;
		
		if(!empty($ancre)): ?>
			<a href="#<?=$ancre;?>">Dernière question gérée.</a>
		<?php elseif($ancre === ''):?>
			<a href="#<?=count($questions);?>">Dernière question gérée.</a>
		<?php endif;?>
		</u>
	</p>
</article>

<article class="mt-5 questionnaire">
	<h3>Ajouter une question</h3>
    <form method="post" action="index.php?page=riasec-questions-manager">
	<!--
	Loren ipsum for the tests in textarea below:
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet tempus lorem. Mauris porta auctor tortor.  -  < ?=date('h:i:s A'); //Insert hour min sec for the tests  ?>
	-->	
	
	  <textarea class="left" cols="150" rows="3" name="question" required></textarea><br>
	  
	  <p><strong>Thème</strong> : <?php foreach($themesList as $theme): ?>
		<label><input type="radio" name="theme" value="<?=$theme["theme"]?>" required
		<?php if($theme["theme"] === $lastThemeChoosen) echo "checked";?>
		> <?=$theme["theme"]?></label> &nbsp; <?php endforeach?></p>

	  <p><strong>Profil</strong>: <?php foreach($profilesList as $profile): ?>
		<label><input type="radio" name="profile" value="<?=$profile["profile"]?>" required
		<?php if($profile["profile"] === $lastProfileChoosen) echo "checked";?>
		> <?=$profile["profile"]?></label> &nbsp; <?php endforeach?></p>

	  <input type="hidden" name="anchor" value="<?=$anchor;?>" />
	  <input type="hidden" name="operation" value="creation" />
	  <input class="right"  type="submit" size="300" value="Enregistrer" />
  </form>
	<hr>
</article>

<article class="questionnaire mt-5">
	
	
	<h3 class="h4">Thème : <?=$theme_choice?></h3>

	<p>Filtrer par thème : 
	<?php foreach($themesList as $line):?>
	<a href="index.php?page=riasec-questions-manager&theme_choice=<?=$line["theme"]?>"><?=$line["theme"]?></a> - 
	<?php endforeach;?>
	</p>
</article>

<article class="questionnaire">
	<table class="riasec-questions-manager">
		<!-- My table first line -->
		<tr>
		  <th>Id</th>
		  <th>Question</th>
		  <th>Thème</th>
		  <th>Profil</th>
		</tr>
		<?php

		// Displays data in a form to edit
		foreach($questions as $donnees) // Chaque entrée sera récupérée et placée dans un array.
		{ 
		?>
		<!-- Second line -->
		<tr id="<?php $anchor=$count; echo $anchor; $count++;?>">

		<form method="post" action="index.php?page=riasec-questions-manager">
		
		<td>
		  <?=$donnees["id"]?>
		</td>
		<td>
		  <textarea class="left" cols="80" rows="3" name="question"><?=$donnees['question'];?></textarea>
		</td>
		<td class="questions_radio">
			<?php foreach($themesList as $theme): ?>
			<label><input type="radio" name="theme" value="<?=$theme["theme"]?>"
			<?php if($theme["theme"] === $donnees["theme"]) echo "checked" ?>		
			> <?=$theme["theme"]?>
			</label><br>
			<?php endforeach?>
		</td>
		<td class="questions_radio">
			<?php foreach($profilesList as $profile): ?>
			<label><input type="radio" name="profile" value="<?=$profile["profile"]?>" 
			<?php if($profile["profile"] === $donnees["profile"]) echo "checked"; ?> >
			<?=$profile["profile"]?></label><br> <?php endforeach?>
		</td>

		<td>
		  <input type="hidden" name="id" value="<?=$donnees['id']?>" />
		  <input type="hidden" name="theme_choice" value="<?=$theme_choice?>" />
		  <input type="hidden" name="operation" value="update" />
		  <input type="hidden" name="anchor" value="<?=$anchor?>" />
		  <input class="m-1 btn" type="submit" value="Enregistrer" />
		</form>
		
		<!--<td class="center">-->
		<span class="center m-1">
		<form method="post" action="index.php?page=riasec-questions-manager">
		  <input type="hidden" name="id" value="<?=$donnees['id'];?>" />
		  <input type="hidden" name="theme_choice" value="<?=$theme_choice?>" />
		  <input type="hidden" name="anchor" value="<?php echo $anchor;?>" />
		  <input type="hidden" name="operation" value="delete" />
		  <input class="m-1 btn"  type="submit" value="del" />
		  </form>
		</td>
		</tr>
	  <?php 
		}   // ferme "while($donnees=$reponse->fetch())" ci-dessus
	  ?>
	</table>
</article>

<?php
}
else
{
	?>
	<header>
	<h2>Choix du thème</h2>
	</header>
	<article>
		<ol> 
		<?php
		foreach($themesList as $line):?>
		<li>
		<a href="index.php?page=riasec-questions-manager&theme_choice=<?=$line["theme"]?>"><?=$line["theme"]?></a>
		</li>
		<?php endforeach;?>
		</ol>
	</article>
	<?php
}
?>