<!--                            - Vue __explorer -
                                    M.L. Harnist
                                     25/03/2018

Pour ce fichier on n'affiche pas l'en-tête -->
<style> header.principal, footer {display:none;}
       .bg-secondary {background-color:white !important;}
       .bg-light {background-color:white !important;}</style>
<div class="pb-5 bg-light">
<article>
 <header class="p-3">
  <h2 class="row">Index of <?=$repertoire_a_explorer;?></h2>
 </header>
 <hr>
 <table class="table-borderless"><!-- Tableau de 6 colonnes -->
  <tr><th><a href="#?C=N&O=D">Name</a></th><th class="pl-2 pr-2"><a href="#?C=M;O=A">Last modified</a></th><th class="pl-2 pr-2"><a href="#?C=S;O=A">Size</a></th><th class="pl-2 pr-2"><a href="#?C=D;O=A">Description</a></th><th class="pl-2 pr-2" colspan="2">Action</th></tr>
  <?php
  foreach($explorateur as $line){
   if($line["type"] == "dir"){ //col 5
    if($line['file_name'] == ".."){ // col 6 ?>
     <tr><td><a href="./<?=$line["url"];?>"><img src="img/dossier-parent.png" alt="Dossier parent"> Dossier parent</a></td><td></td><td></td><td></td><td></td><td></td></tr>
     <?php 
    }  //Ferme if($line['file_name'] == "..")
   } //Ferme if($line["type"] == "dir") col 5
   else {//Else de if($line["type"] == "dir")
   ?>
   <tr>
    <td><img src="img/<?=$line["extension"];?>.png" alt="logo image"> <?=$line["file_name"];?></td><td class="pl-2 pr-2"><?=$line['last_modified']?></td><td class="pl-2 pr-2"><?=$line['size']?></td><td class="pl-2 pr-2"><?=$line['description']?></td>
     <td><a class="text-success" href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" . $line['dir'] . "/" . $line['file_name'];?>">Edit</a></td>
     <td> <a href="index.php?page=__files-edition&file=<?=$_SERVER['DOCUMENT_ROOT']."/".$line['domaine']. "/" .  $line['dir'] . "/" . $line['file_name'];?>&operation=supprimer">Del</a></td>
    </tr>
    <?php
   }//Ferme else de if($line["type"] == "dir") col 5
  }//Ferme foreach col 4
  ?>
 </table>
 <?php
 if($explorer->new_dir_creation == True){?>
  <p style="background-color: pink; padding:20px;"><i>"Intelligence artificielle en marche: le chemin du repertoire a été corrigé de  <span style="color:red; font-size:25px;">"<?=strtolower($explorer->first_dir_name);?>"</span> en <span style="color:green;  font-size:25px;">"<?=$explorer->new_dir;?>"</span>!" Le programme a trouvé tout seul le bon chemin du répertoire à explorer.</i></p>
  <?php
 }
 ?>
</article>
