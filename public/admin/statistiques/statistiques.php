<article class="statistiques">
  <header class="row bg-light">
      <h2 class="text-muted m-3">Visites</h2>
    </header>
	<div class="row">
		<?php
		foreach($stats as $val):
		?>
		<div class="col-lg-2 border mr-1 mt-3 pt-2">
			<p class="text-center"><?=isset($val['name'])?ucfirst($val['name']):"inconnu"?></p>
			<hr>
			<p class="text-center"><?=isset($val['visits'])?$val['visits']:"0"?></p>
			<figure class="bg-secondary"
			
			style="height:<?=isset($val['visits'])?$val['visits']:"0"?>px"
			
			></figure>
		</div>
		<?php
		endforeach;
		?>
	</div>
</article>