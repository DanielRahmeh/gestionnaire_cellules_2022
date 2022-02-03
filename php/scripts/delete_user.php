<!-- Script permettant de supprimer un compte utilisateur -->

<?php
   // Appel du fichier permettant de se connecter à la bdd
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }  

   // Récuperation de l'email du compte en question
   if (isset($_GET['delete']))
      $email_user = $_GET['delete'];
   
   // Reqête permettant de supprimer le compte utilisateur
   $query = $bdd->prepare('DELETE FROM user WHERE email_user = :email_user');
   $query->execute(array(
      'email_user' => $email_user));

   // Redirection avec message de validation de la suppression
   header('Location: ../pages/settings_admin.php?delete=1&check_delete=' . $email_user);
?>