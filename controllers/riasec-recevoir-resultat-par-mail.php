<?php
$messager = new Message();
$erreur = false;    
$capcha = isset($_POST['capcha'])?htmlspecialchars($_POST['capcha']):"";
$capcha_reponse = isset($_POST['capcha_reponse'])?$_POST['capcha_reponse']:"";

//Get user's his saved values
if(isset($_POST['user_name']))
{
    $user = new User();
    isset($_POST['user_civilite'])?$user->setCivilite($_POST['user_civilite']):"";
    isset($_POST['user_name'])?$user->setName($_POST['user_name']):"";
    isset($_POST['user_firstName'])?$user->setFirstName($_POST['user_firstName']):"";
    isset($_POST['user_r'])?$user->setR($_POST['user_r']):"";
    isset($_POST['user_i'])?$user->setI($_POST['user_i']):"";
    isset($_POST['user_a'])?$user->setA($_POST['user_a']):"";
    isset($_POST['user_s'])?$user->setS($_POST['user_s']):"";
    isset($_POST['user_e'])?$user->setE($_POST['user_e']):"";
    isset($_POST['user_c'])?$user->setC($_POST['user_c']):"";
    isset($_POST['profile3letters'])?$user->setProfile3letters($_POST['profile3letters']):"";
}
//If user do not exists
elseif(!isset($user))
{ 
    $user = new User();
}
//GET all posts
$firstname = isset($_POST['firstname'])?$_POST['firstname']:"";
$name = isset($_POST['name'])?$_POST['name']:"";
$civilite = isset($_POST['civilite'])?$_POST['civilite']:"";
$email = isset($_POST['email'])?$_POST['email']:"";

//Update user name and firstname
$user->hydrate([
				'firstname' => $firstname,
				'name' => $name,
				'civilite' => $civilite,
				'email' => $email,
				]);

$destinataire = $email; // $mail_du_site in config.php


//Prepare mail
$objet = 'Mail du site web ' . WEBSITE_NAME;
  
$message = isset($_POST['message'])?htmlspecialchars($_POST['message']):"";
$message=nl2br($message);
$message =<<<EOF
<html>
<body>
{$message}
</body>
</html>
EOF;
$header = "Content-Type: text/html; charset=UTF-8;";
$header .= "\nFrom: " . OWNER_MAIL;

// Vérifications
if(isset($_POST['security']) && $_POST['security'] === "ok" )
{
    // Vérification du mail 
    if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) {
        $messager->setRed(" Veuillez indiquer un email valide.");
        $erreur = true;
        $messageSent = False;
    }    
    if ( $email == "") {
        $messager->setRed(" Veuillez indiquer un email valide.");
        $erreur = true;
        $messageSent = False;
    }
    if ( $capcha == "" ) {
        $messager->setRed(' Vous avez oublié de répondre à la question "Je ne suis pas un robot".');
        $erreur = true;
        $messageSent = False;
    } elseif ( $capcha != $capcha_reponse ){
        $messager->setRed(" Vous vous êtes trompé à la question \"Je ne suis pas un robot.\"");
        $erreur = true;
        $messageSent = False;
    }
    if ( $message == "" ) {
        $messager->setRed(" Le message est vide.");
        $erreur = true;
        $messageSent = False;
    }
    //Il ne reste plus qu'à envoyer le mail si 0 erreur a été trouvée
    if (!$erreur && $email !== "") 
    {
          //Save the user in db
          if(isset($user))
          {
                $userManager = new UserManager;
				$userAddReturn = $userManager->add($user);
          }
          //Send mail to this user
        mail( $destinataire , $objet , $message , $header );
        $messageSent = True;
    }
}
