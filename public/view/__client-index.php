<article>
  <header class="row bg-light">
    <h2 class="row ml-0 text-muted">Index des clients</h2>
  </header>   
  <div class="col-sm-12 mt-3">

    <!-- ************************ AFFICHAGE UPDATE ******************* -->
    <table class="table table-striped"><!-- Bootstrap class -->
      <tr>
        <th>Id </th>
        <th>Civilité </th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Mot de passe</th>
        <th>Téléphone</th>
        <th>Level</th>
        <th colspan="2">Action</th>
      </tr>
          <?php
	//var_dump($datas);
	//die();

          // Langage moderne en POO avec paanaim Nekudetaïm (::) et FETCH_ASSOC 
          foreach($datas as $data){?>  
      <tr id="<?php $ancre=$count; echo $ancre; $count++;?>">
          <!-- id du formulaire supprimés: leur duplication != valid html5 --> 
          <form method="post" action="<?= $website->page_url;?>__client-update">
			  <td>
				<input type="text" size="1" name="new_id" value="<?=$data['id'];?>">
				<input type="hidden" name="id" value="<?=$data['id'];?>"><!-- on sauve la valeur de l'ancien id-->
			  </td>
			  <td>
				<input type="text" size="2" name="civilite" value="<?=$data['civilite']?>">
			  </td>
			  <td>
				<input type="text" size="4" name="name" value="<?=$data['name']?>">
			  </td>
			  <td>
				<input type="text" size="4" name="firstname" value="<?=$data['firstname']?>">
			  </td>
			  <td>
				<input type="text" name="email" value="<?=$data['email']?>">
			  </td>
			  <td>
				<input type="text" size="40" name="password" value="<?=$data['password']?>">
			  </td>
			  <td>
				<input type="text" size="6" name="phone" value="<?=$data['phone']?>">
			  </td>
			  <td>
				<input type="text" size="1" name="level" value="<?=$data['level']?>">
			  </td>
			  <td class="center">
				<input type="hidden" name="ancre" value="<?php echo $ancre;?>">
				<input type="hidden" name="operation" value="update">
				<input type="submit" value="Edit">
			  </td>
		  </form>
				<td class="center"><span class="center">
					<form method="post" action="<?= $website->page_url;?>__client-delete">
					  <input type="hidden" name="id" value="<?=$data['id'];?>">
					  <input type="hidden" name="ancre" value="<?=$ancre;?>">
					  <input type="hidden" name="operation" value="delete">
					  <input type="submit" value="del">
					</form>
				</td>
        <?php 
      }// Ferme foreach($datas as $data)
    ?>
	</table>
  </div>
</article>
