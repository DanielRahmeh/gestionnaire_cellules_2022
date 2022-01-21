<?php
   require ('connect_to_db.php');
   $db = new Database();
   $bdd = $db->getConnection();
   if (!$bdd) {
         die("Error connecting to the database");
      }
   $reponse = $bdd->query("SELECT * FROM user");
   $count = 0;
   while ($donnees = $reponse->fetch()) {  
      if ($_POST['email'] == $donnees['email_user'] && password_verify($_POST['password'], $donnees['password_user'])) {
         $count = 1;
         if (!isset($_SESSION))
            session_start();
         $_SESSION['email'] = $_POST['email'];
         $_SESSION['password'] = $_POST['password'];
         $_SESSION['admin'] = $donnees['admin_user'];
         if (!empty($_POST["stay_connected"])) {
            setcookie('email', $_POST['email'], time()+36000, '/');
            setcookie('password', $_POST['password'], time()+36000, '/');
            setcookie('admin', $admin, time()+36000, '/');
         }
         header('Location: ../pages/principal.php'); 
      }
   }
   if ($count == 0)
      header('Location: ../pages/login.php?erreur=1');
?>