<header>
    <h2>Modifier les données</h2>
</header>   
<article>
  <div class="col-sm-12 mt-3">
  <?php
  /**   TRAVAUX EN COURS
  *     Embellissement de cette page.
  *
  */
  ?>
  <!-- ************************ AFFICHAGE UPDATE ******************* -->

<!--
Formulaire - db  
Id - id
Civilité - civilite
Nom - name
Prénom - firstname
Email - email 
Mot de passe - password
Téléphone - phone
Niveau - level
-->
          <form method="post" action="<?= $website->page_url;?>client-update">

        <div class="form-group row">
		  <label for="civilite" class="col-sm-2 col-form-label">Civilité</label>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1"
				 value="Mme" <?php if($client_en_cours_de_lecture['civilite'] == 'Mme') echo 'checked ';?> required>
			  <label class="form-check-label" for="inlineRadio1">Madame</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2"
				 value="Meur" <?php if($client_en_cours_de_lecture['civilite'] == 'Meur') echo 'checked ';?> >
			  <label class="form-check-label" for="inlineRadio2">Monsieur</label>
			</div>
		</div>
        <div class="form-group row">
		  <label for="name" class="col-sm-2 col-form-label">Nom</label>
			<div class="col-sm-10">
			  <input 
				type="text" 
				class="form-control" 
				id="name" 
				name="name" 
				placeholder="Nom"
                                value="<?=$client_en_cours_de_lecture['name'];?>"
				disabled>
			  <input 
				type="hidden" 
				class="form-control" 
				id="name" 
				name="name" 
				placeholder="Nom"
                                value="<?=$client_en_cours_de_lecture['name'];?>">
			</div>
        </div>
        <div class="form-group row">
          <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
          <div class="col-sm-10">
            <input 
			type="text" 
			class="form-control" 
			id="firstname" 
			name="firstname" 
			placeholder="Prénom" 
			value="<?=$client_en_cours_de_lecture['firstname']?>"
			required>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input 
			type="email" 
			class="form-control" 
			id="email" 
			name="email" 
			placeholder="Email"
			value="<?=$client_en_cours_de_lecture['email']?>"
			required>
          </div>
        </div>

        <div class="form-group row">
          <label for="phone" class="col-sm-2 col-form-label">Téléphone</label>
          <div class="col-sm-10">
            <input type="tel" maxlength="250" class="form-control" name="phone" id="phone" placeholder="Téléphone"
		value="<?=$client_en_cours_de_lecture['phone']?>"
		required>
          </div>

        </div>
		
	<!-- Niveau du membre : 5 par défaut = client -->
        <input class="form-check-input" type="hidden" name="level" value="5">

	<!-- Données conservées telles qu'elles -->
        <input type="hidden" name="id" value="<?=$client_en_cours_de_lecture['id']?>">
        <input type="hidden" name="new_id" value="<?=$client_en_cours_de_lecture['id']?>">

	<!-- Pour le mot de passe il faudra faire quelque chose de plus poussé avec des confirmations ! -->
        <input type="hidden" name="password" value="<?=$client_en_cours_de_lecture['password']?>">

		<div class="form-group row">
          <div class="col-sm-10">
		
		<input type="hidden" name="operation" value="update">

            <button type="submit" class="btn lightColor text-white">Enregistrer</button>
          </div>
        </div>

  </form>
				
  </div>
</article>
