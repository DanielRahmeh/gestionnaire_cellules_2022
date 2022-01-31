<?php
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
      die("Error connecting to the database");
   }  
   if (isset($_GET['email']) && isset($_POST['pass']) && isset($_POST['nPass'])) {
      $email_user = $_GET['email'];
      echo ($email_user . '<br />' . $_POST['pass']);
      $password_user = password_hash($_POST['pass'], PASSWORD_DEFAULT);
      $query = $bdd->prepare('UPDATE user SET password_user = :password_user WHERE email_user = :email_user');
      $query->execute(array(
         'email_user' => $email_user,
         'password_user' => $password_user));
   }
   header('Location: ../pages/settings.php?mdp=1');
?>