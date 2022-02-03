<!-- Script permettant de modifier le mot de passe d'un utilisateur -->

<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }
   
   // Récuperation de l'email du compte en question et du nouveau mot de passe saisi
   if (isset($_GET['email']) && isset($_POST['pass']) && isset($_POST['nPass'])) {
      $email_user = $_GET['email'];

      // Cryptage du mot de passe
      $password_user = password_hash($_POST['pass'], PASSWORD_DEFAULT);

      // Reqête permettant de modifier le mot de passe
      $query = $bdd->prepare('UPDATE user SET password_user = :password_user WHERE email_user = :email_user');
      $query->execute(array(
         'email_user' => $email_user,
         'password_user' => $password_user));
   }

   // Redirection avec message de confirmation de modification
   header('Location: ../pages/settings.php?mdp=1');
?>