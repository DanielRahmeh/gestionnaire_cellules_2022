<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
   }
   $email_user = $_POST['email'];
   if (isset($_GET['password']) && $_GET['password'] != '')
      $password_user = $_GET['password'];  
   else
      $password_user = $_POST['pass'];
   $base_password = $password_user;
   $hash_password = password_hash($password_user, PASSWORD_DEFAULT);
   $admin_user = 0;
   if (isset($_POST['rights']))
      $admin_user = 1;
   $date_inscription = date('y-m-d');
   $reponse = $bdd->query("SELECT * FROM user");
   $count = 0;
   while ($donnees = $reponse->fetch())
       {
         if ($email_user == $donnees['email_user'])
            $count = 1;
       }
   if ($count == 1)
      header('Location: ../pages/settings_admin.php?erreur=1');
   else {
      echo("email : " . $email_user . " password : " . $base_password . " rights : " . $admin_user . " date : ". $date_inscription);
      $query = $bdd->prepare("INSERT INTO user(email_user, password_user, admin_user, date_inscription) 
                              VALUES(:email_user, :hash_password, :admin_user, :date_inscription)");
      $query->execute(array(
                           'email_user' => $email_user,
                           'hash_password' => $hash_password,
                           'admin_user' => $admin_user,
                           'date_inscription' => $date_inscription));
      // Protocole d'envoi de mail
      require 'send_mail.php';
      send_mail('Inscription au gestionnaire de cellules',
               'Bonjour,<br /><br />
               Vous avez été inscrit sur l\'application \'Gestionnaire de cellules\'.<br />
               Voici vos identifiants : <br />
               -email : <b>' . $email_user . '</b><br />
               -mot de passe : <b>' . $base_password . '</b><br /><br />
               Nous vous remercions de votre confiance.<br /><br />
               Cordialement,<br />
               L\'équipe technique de Numerica.',
               $email_user);
      header('Location: ../pages/settings_admin.php?valide=1');     
   }
?>