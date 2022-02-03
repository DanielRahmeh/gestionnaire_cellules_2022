<!-- Script permettant la création d'un nouveau compte utilisateur -->

<?php
   // Appel des fichiers permettant le protocol de mailing
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
   }

   // Récupération de l'email saisi
   $email_user = $_POST['email'];

   // Récupération du mdp saisie
   if (isset($_GET['password']) && $_GET['password'] != '')
      $password_user = $_GET['password'];  
   else
      $password_user = $_POST['pass'];
   $base_password = $password_user;

   // Cryptage du mot de passe
   $hash_password = password_hash($password_user, PASSWORD_DEFAULT);

   // Mise en place des droits du compte
   $admin_user = 0;
   if (isset($_POST['rights']))
      $admin_user = 1;

   // Date d'inscrption à la date déxecution du script
   $date_inscription = date('y-m-d');

   // Requête permettand de récupérer les données utilisateur
   $reponse = $bdd->query("SELECT * FROM user");

   $count = 0;
   while ($donnees = $reponse->fetch())
      {
         //  Vérification si l'adresse mail saisie correspond à une adresse mail enregistré dans la base de données
         if ($email_user == $donnees['email_user'])
            $count = 1;
      }
   // L'adresse mail est déjà existant redirection vers la page précédente avec un message d'erreur
   if ($count == 1)
      header('Location: ../pages/settings_admin.php?erreur=1');
   
   else {
      // Requête permettant d'insérer les données saisie dans la table user
      $query = $bdd->prepare("INSERT INTO user(email_user, password_user, admin_user, date_inscription) 
                              VALUES(:email_user, :hash_password, :admin_user, :date_inscription)");
      $query->execute(array(
                           'email_user' => $email_user,
                           'hash_password' => $hash_password,
                           'admin_user' => $admin_user,
                           'date_inscription' => $date_inscription));

      // Appel du fichier permettant l'envoi de mail
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

      // Redirection vers la page précédent avec message de validation de création
      header('Location: ../pages/settings_admin.php?valide=1');     
   }
?>