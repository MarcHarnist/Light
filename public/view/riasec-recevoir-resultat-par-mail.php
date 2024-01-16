<?php
isset($erreur)?'':exit("root/view/contact_verif.php Erreur: le contrôleur est introuvable.");
if (!$erreur && isset($messageSent) && $messageSent === True):?>
    <header>
        <h2>Succès !</h2>
    </header>
    <article>
		<?php // Webmaster catch exception ?>
		<p class="text-danger"><?//=$userAddReturn===True?"":$userAddReturn?></p>
        <p class = "text-success text-center">Vos résultats sont bien envoyés par courriel vers votre boite aux lettres.
        </p>
		<p class="mb-3 text-center">Si ce service vous a semblé utile, soutenez notre projet à partir de 5 € !</p>
		
		<?php
		$fileMenuPageManager = PUBLIC_PATH.'/inc/paypal-bouton-2.php';
		is_file($fileMenuPageManager)?require($fileMenuPageManager):
		print("<i>Le fichier inclusion du bouton Paypal est introuvable.</i>");
else:
    if(isset($erreur) && isset($messageSent) && $messageSent === False ):
        ?>
        <header>
            <h2>Message</h2>
        </header>
        <article>
            <h3>Petite erreur :</h3>
            <?php
            if(isset($messager) && is_object($messager))
            {
                if(($messager->getRed()) != ""){
                    ?>    
                    <p class = "messageRed">
                    <?php echo $messager->getRed();?>
                    </p>
                    <?php
                }
            }
            ?>
        </article> 
    <?php
    endif;
     ?>
    <header>    
        <h2>Renseignez vos coordonnées pour recevoir les résultats par email</h2>
    </header>    
    <article>
        <div class="col-sm-12">
            <form action="index.php?page=riasec-recevoir-resultat-par-mail" method="post">
              <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Entrez votre email" required value="<?=isset($email)?$email:""?>">
                <small id="emailHelp" class="form-text text-muted">Nous ne communiquerons jamais votre mail à quelqu'un d'autre.</small>
              </div>
              <div class="form-group row mt-1">
                  <label for="civilite" class="col-sm-2 col-form-label">Civilité</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Mme" required <?php if(isset($civilite) and $civilite === "Mme") echo "checked";?>>
                      <label class="form-check-label" for="inlineRadio1">Madame</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Meur"  <?php if(isset($civilite) and $civilite === "Meur") echo "checked";?>>
                      <label class="form-check-label" for="inlineRadio2">Monsieur</label>
                    </div>
                </div>

                <div class="form-group row mt-1">
                  <label for="name" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                      <input 
                        type="text" 
                        pattern="[a-zA-Z0-9]{,20}"
                        maxlength="20"
                        class="form-control" 
                        id="name" 
                        name="name" 
                        placeholder="(Maximum 20 lettres et chiffres)"
                        value="<?=isset($name)?$name:""?>"
                        required>
                    </div>
                </div>
                <div class="form-group row mt-1">
                  <label for="firstname" class="col-sm-2 col-form-label">Prénom</label>
                  <div class="col-sm-10">
                    <input 
                    type="text" 
                    pattern="[a-zA-Z0-9]{,2}"
                    maxlength="20"
                    class="form-control" 
                    id="firstname" 
                    name="firstname" 
                    placeholder="(Maximum 20 lettres et chiffres)"
                    value="<?=isset($firstname)?$firstname:""?>"
                    required>
                  </div>
                </div>
              <!-- RGPD -->
              <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label" for="rgpd">
                      <input class="form-check-input" type="checkbox" id="rgpd" required>
                        * En soumettant ce formulaire, j’accepte que les informations personnelles fournies soient exploitées dans le cadre de ma demande et de la relation qui peut en découler.
                    </label>
                </div>
              </div>
              <!-- Fin RGPD -->
              <div class="form-group">
                <label for="capcha">Je ne suis pas un robot : </label>
                    <?php $capcha = rand(1,5); 
                    echo ' ' . $capcha;?> + 1 = <input class="rounded" id="capcha" name="capcha_reponse" size="3" <?=isset($capcha)?$capcha:""?>>
                    <input type="hidden" name="capcha" value="<?php $capcha++;
                    echo $capcha;?>" required>
              </div>
                <input type="hidden" name="security" value="ok">
                <input type="hidden" name="user_civilite" value="<?=$user->getCivilite()?>">
                <input type="hidden" name="user_name" value="<?=$user->getName()?>">
                <input type="hidden" name="user_firstName" value="<?=$user->getFirstName()?>">
                <input type="hidden" name="user_r" value="<?=$user->getR()?>">
                <input type="hidden" name="user_i" value="<?=$user->getI()?>">
                <input type="hidden" name="user_a" value="<?=$user->getA()?>">
                <input type="hidden" name="user_s" value="<?=$user->getS()?>">
                <input type="hidden" name="user_e" value="<?=$user->getE()?>">
                <input type="hidden" name="user_c" value="<?=$user->getC()?>">
                <input 
				type="hidden" 
				name="message" 
				value="Merci d'avoir visité le site web <?=WEBSITE_NAME?> !<?="\n"?>
				Voici les résultats de votre test : 
				<?="\n"?>
				Votre profil principal : <?=$user->getProfile3letters()?>
				<?="\n"?>
				<?="\n"?>
				Détails de votre profil:<?="\n"?>
				<?php
				$userResults = $user->getResultArsort();
				// $profileName = realist, investigator, artistic...
				foreach($userResults as $profileName => $value)
				{
					echo ucfirst($profileName)." : ".$value."\n";
				}
				//Last entry : add a point at coma place !
				echo ucfirst($profileName)." : ".$value." .";
				?>"
				>
                
              <button type="submit"class="btn lightColor text-white">Envoyer</button>
            </form>
        </div>
    </article>
	<?php
endif;
?>