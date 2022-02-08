<?php
// Script permettant d'accorder les droits administrateur à un compte utilisateur


   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }

   // Récuperation de l'email du compte en question
   if (isset($_GET['new_admin']))
      $email_user = $_GET['new_admin'];

   $admin_user = 1;

   // Reqête permettant d'éffectuer la modification et d'accorder les droits admin
   $query = $bdd->prepare('UPDATE user SET admin_user = :admin_user WHERE email_user = :email_user');
   $query->execute(array(
      'email_user' => $email_user,
      'admin_user' => $admin_user));

   // Redirection avec message de validation de modification
   header('Location: ../pages/settings_admin.php?delete=1&check_new_admin=' . $email_user);
?>