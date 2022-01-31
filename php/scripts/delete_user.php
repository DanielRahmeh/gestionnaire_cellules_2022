<?php
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }  
   if (isset($_GET['delete']))
      $email_user = $_GET['delete'];
   $query = $bdd->prepare('DELETE FROM user WHERE email_user = :email_user');
   $query->execute(array(
      'email_user' => $email_user));
   header('Location: ../pages/settings_admin.php?delete=1&check_delete=' . $email_user);
?>