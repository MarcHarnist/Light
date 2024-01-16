<!--
           Page Config-file-edition
									
	File : root/view/config-file-edition.php
	Author : Marc L. Harnist
	Date : 2020-07-02
	Do : receive model/config-file-reading-short-complete form/$_POST
	and work on them
-->
<article>
  <header class="row">
    <h2 class="col-lg-12 ml-0 mt-4 ">Config file édition</h2>
  </header>
  <section class="col-lg-12 ">
    <h3 class="h5"><i>Traitement des données du formulaire du modèle "config-file-reading-short-complete"</i></h3>
	<?php if(isset($message)) echo $message[0]; else echo "Pas de message créé à afficher.";?>  </section>
</article>
