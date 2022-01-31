<?php
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }  
   if (isset($_GET['new_admin']))
      $email_user = $_GET['new_admin'];
   $admin_user = 1;
   $query = $bdd->prepare('UPDATE user SET admin_user = :admin_user WHERE email_user = :email_user');
   $query->execute(array(
      'email_user' => $email_user,
      'admin_user' => $admin_user));
   header('Location: ../pages/settings_admin.php?delete=1&check_new_admin=' . $email_user);
?>