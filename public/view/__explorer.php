<!--                            - Vue __explorer -
                                    M.L. Harnist
                                     25/03/2018

-->		
<div class="pb-5 bg-light">
<article>
    <header class="p-3">
        <h2 class="row">INDEX OF</h2>
    </header>   
    <h3 class="h6"><a href="kcfinder">--> Dossier des images</a></h3>
    <h3 class="h6"><a href="<?=$website->page_url?>__explorer_epure">--> Explorer épuré</a></h3>
    <hr>
                <?php 
    if($explorer->chemin == True)
        echo  "<p>Le chemin est juste.</p><hr>";
    else
        echo  "<p>Le chemin est inexact.</p><hr>";

    if($explorer->dir_existe == False){
        //répertoire non trouvé
        ?>
        <p>Désolé, le répertoire "<span class="text-danger"><?=$repertoire_a_explorer?></span>" est introuvable.</p>    
        <hr>
        <form method="post" action="#">
            <p>Choisissez un autre repertoire: <input type="text" name="other_dir"> <input type="submit" name="envoyer"></p>
        </form>
        <?php
    }
    else{
        ?>
        
    <p>Vous avez choisi le répertoire "<span class="text-success"><?=$repertoire_a_explorer?></span>".</p>  
    <hr>
    <p>Menu, nav ou navigateur: <?=$navigateur;?></p>

    <form method="post" action="#">
        <p>Choisir un autre repertoire: <input type="text" name="other_dir"> <input type="submit" name="envoyer"></p>
    </form>
    <hr>
    <p><strong>Important:Pour les suppressions: Seules les copies sont supprimées, si nom du fichier contient "copie"</strong></p>
    <table class="table table-striped"> 
<?php
foreach($explorateur as $line){
  if($line["type"] == "dir"){ 
    if($line["file_name"] == "."){
      $line['file_name'] == "Dossier parent";
      ?>
      <tr><td><a href="./<?=$line["url"]."/".$repertoire_a_explorer;?>"><img src="img/dir.png"> <?=$line["dir"];?></a></td></tr>
      <?php
    }
    elseif($line['file_name'] == ".."){
      ?>
      <tr><td><a href="./<?=$line["url"];?>"><img src="img/dossier-parent.png"> Dossier parent</a></td></td>
      <?php
    }
    else{
      ?>
      <tr>
      <td><a href="<?=$line['url']?>" title="Ouvrir"><img src="img/dir.png"> <?=$line["file_name"];?></a><td>
      <td><a class="text-success" href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" . $line['dir'] . "/" . $line['file_name'];?>">Editer!</a></td>
       <td> <a href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" . $line['dir'] . "/" . $line['file_name'];?>&operation=supprimer">Supprimer</a> 
       </tr>
       <?php
    }
  }//Ferme if($line["type"] == "dir") 
  else {
	?>
	<tr>
	<td><img src="img/<?=$line["extension"];?>.png"> <?=$line["file_name"];?></a><td>
	<td><a class="text-success" href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" . $line['dir'] . "/" . $line['file_name'];?>">Editer!</a></td>
	<td> <a href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" .  $line['dir'] . "/" . $line['file_name'];?>&operation=supprimer">Supprimer</a> 
	</tr>
	<?php
	}
}
?>
</table>
                    <?php
    if($explorer->new_dir_creation == True){ ?>
    <p style="background-color: pink; padding:20px;"><i>"Intelligence artificielle en marche: le chemin du repertoire a été corrigé de <span style="color:red; font-size:25px;">"<?=strtolower($explorer->first_dir_name);?>"</span> en <span style="color:green; font-size:25px;">"<?=$explorer->new_dir;?>"</span>!" Le programme a trouvé tout seul le bon chemin du répertoire à explorer.</i></p>
                    <?php
                    }
    }//Ferme else de if($explorer == False): répertoire non trouvé
                ?>
</article>
